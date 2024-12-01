<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Order;
use Livewire\Component;
use App\Events\PesananBaru;
use App\Models\DetailAddon;
use App\Models\DetailOrder;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Log;



class Checkout extends Component
{
    public $cartItems = [];
    public $totalHarga = 0;
   
    public function mount()
    {
        // Mendapatkan data cart dari session
        $this->cartItems = session()->get('cart', []);
        if (empty($this->cartItems)) { 
            return redirect()->route('order.menu', ['nomorMeja' => session('meja')]); 
        }

        $now = Carbon::now();

        // Ambil detail menu berdasarkan id_menu untuk setiap item di cart
        foreach ($this->cartItems as &$item) {
            $item['menu'] = Menu::find($item['id_menu']); // Ambil menu berdasarkan id_menu
            $item['quantity'] = $item['quantity'] ?? 1; // Default kuantitas jika tidak ada
            $item['notes'] = $item['notes'] ?? '';      // Default notes kosong jika tidak ada

            // Ambil add-ons terkait menu
            if ($item['menu']) {
                // Cek apakah menu memiliki promo yang masih valid
                $promo = $item['menu']->promo;
                if ($promo && $promo->status === 'Aktif' && 
                    ($promo->hari === 'AllDay' || $promo->hari === $now->format('l')) &&
                    $now->between($promo->waktu_mulai, $promo->waktu_berakhir)) {
                    $item['menu']['harga'] = $promo->harga_promo; // Gunakan harga promo
                }

                $addonsFromDb = $item['menu']->addOns()->get();
                // Sinkronisasi add-on dari database dan session
                $item['addOn'] = $addonsFromDb->map(function ($addon) use ($item) {
                    $existingAddon = collect($item['addOn'] ?? [])->firstWhere('id_addon', $addon->id_addon);
                    return [
                        'id_addon' => $addon->id_addon,
                        'nama_addon' => $addon->nama_addon,
                        'harga' => $addon->harga,
                        'quantity' => $existingAddon['quantity'] ?? 0, // Ambil kuantitas dari session jika ada
                    ];
                })->toArray();
            } else {
                $item['addOn'] = [];
            }
        
        }

        Log::info('Item after fetch from cart: ' . json_encode($this->cartItems, JSON_PRETTY_PRINT)); 
        // Hitung total harga awal
        $this->calculateTotal();
    }


    private function calculateTotal()
    {
        $total = 0;

        foreach ($this->cartItems as $item) {
            $total += $item['menu']['harga'] * $item['quantity'];

            foreach ($item['addOn'] as $addon) {
                $total += $addon['harga'] * $addon['quantity'];
            }
        }

        $this->totalHarga = $total;
    }


    public function updateMenuQuantity($idMenu, $quantity)
    {
        $quantity = max(0, (int)$quantity);

        Log::info('updateMenuQuantity dipanggil untuk idMenu: ' . $idMenu . ' dengan kuantitas: ' . $quantity);

        // Temukan item berdasarkan idMenu
        foreach ($this->cartItems as $index => &$item) {
            if ($item['menu']->id_menu === $idMenu) {
                if ($quantity === 0) {
                    // Jika quantity 0, hapus item dari cart
                    unset($this->cartItems[$index]);
                    Log::info("Item dengan idMenu: $idMenu dihapus karena quantity = 0");
                } else {
                    // Update quantity
                    $item['quantity'] = $quantity;
                    // Perbarui harga jika promo berlaku
                    $now = Carbon::now();
                    $promo = $item['menu']->promo;
                    if ($promo && $promo->status === 'Aktif' &&
                        ($promo->hari === 'AllDay' || $promo->hari === $now->format('l')) &&
                        $now->between($promo->waktu_mulai, $promo->waktu_berakhir)) {
                        $item['menu']['harga'] = $promo->harga_promo;
                    }
                    Log::info('Item diperbarui: ' . json_encode($item, JSON_PRETTY_PRINT));
                }
                break;
            }
        }

        // Reset indeks array untuk memastikan urutannya benar setelah unset
        $this->cartItems = array_values($this->cartItems);

        // Update session cart
        session()->put('cart', $this->cartItems);

        Log::info("Session setelah update quantity: ".  json_encode($this->cartItems, JSON_PRETTY_PRINT));


        //Cek apakah cart kosong atau tidak
        $this->checkEmpty();

        // Hitung ulang total
        $this->calculateTotal();
    }

    public function validateQuantity($idMenu, $quantity)
    {
        Log::info('validateQuantity dipanggil untuk idMenu: ' . $idMenu . ' dengan kuantitas: ' . $quantity);

        // Pastikan kuantitas adalah angka valid >= 0
        $quantity = max(0, (int)$quantity);

        // Temukan indeks item di cart berdasarkan idMenu
        $index = array_search($idMenu, array_column($this->cartItems, 'menu.id_menu'));

        if ($index !== false) {
            // Cek apakah promo masih berlaku
            if (isset($menu['promo']) && $menu['promo']['status'] === 'Aktif') {
                $currentTime = Carbon::now()->format('H:i:s');
                $waktuMulai = $menu['promo']['waktu_mulai'];
                $waktuBerakhir = $menu['promo']['waktu_berakhir'];

                if ($currentTime >= $waktuMulai && $currentTime <= $waktuBerakhir) {
                    // Gunakan harga promo
                    $this->cartItems[$index]['menu']['harga'] = $menu['promo']['harga_promo'];
                } else {
                    // Promo sudah tidak berlaku
                    $this->cartItems[$index]['menu']['harga'] = $menu['harga'];
                }
            }
            $this->cartItems[$index]['quantity'] = $quantity;

            // Hapus item jika kuantitas 0
            if ($quantity == 0) {
                unset($this->cartItems[$index]);
            }

            // Update session cart
            session()->put('cart', $this->cartItems);

            //cek apakah cart kosong atau tidak 
            $this->checkEmpty();
            
            // Hitung ulang total harga
            $this->calculateTotal();
        }
    }

    public function updateAddonQuantity($menuId, $addonId, $action)
    {
        Log::info("Menu ID: $menuId, Addon ID: $addonId, Action: $action");
        // Cari menu dalam cart
        foreach ($this->cartItems as &$item) {
            if ($item['id_menu'] === $menuId) {
                // Cari add-on yang sesuai
                foreach ($item['addOn'] as &$addon) {
                    if ($addon['id_addon'] === $addonId) {
                        if ($action === 'increment') {
                            $addon['quantity']++; // Tambah kuantitas
                        } elseif ($action === 'decrement' && $addon['quantity'] > 0) {
                            $addon['quantity']--; // Kurangi kuantitas
                        }
                    }
                }
            }
        }

        // Simpan kembali ke session
        session()->put('cart', $this->cartItems);

        // Hitung ulang total harga
        $this->calculateTotal();
    }

    public function updateNote($propertyName)
    {
        if (str_contains($propertyName, '.notes')) {
            $parts = explode('.', $propertyName);
            $menuKey = $parts[1] ?? null;

            if ($menuKey && isset($this->cartItems[$menuKey])) {
                // Validasi
                $this->validateOnly($propertyName);

                // Sanitasi
                $this->cartItems[$menuKey]['notes'] = strip_tags($this->cartItems[$menuKey]['notes']);
                
                // Simpan ke session
                session()->put('cart', $this->cartItems);
            }
        }
    }

    public function createOrder()
    {
        $this->checkEmpty();
        $today = Carbon::today();
        $count = 1;

        // Cari order terakhir berdasarkan tanggal yang sama
        $lastOrder = Order::whereDate('waktu_transaksi', $today)->orderBy('antrian', 'desc')->first();

        // Jika ada order sebelumnya di hari yang sama
        if ($lastOrder) {
            // Increment antrian
            $antrian = $lastOrder->antrian + 1;
        } else {
            // Reset antrian ke 1 jika belum ada order di hari ini
            $antrian = 1;
        }
        // Membuat order baru
        $order = Order::create([
            'id_order' => 'ORD-' . Carbon::now()->format('YmdHis') . '-' . $antrian . '-M'.session('meja'),
            'id_user' => '1', // Kosongkan karena akan diisi oleh kasir nanti
            'antrian' => $antrian,
            'customer' => session('nama_customer'),
            'meja' => session('meja'),
            'tipe_order' => 'Dine In',
            'metode_pembayaran' => null,
            'status' => 'Open Bill',
            'total_harga' => $this->totalHarga,
            'waktu_transaksi' => Carbon::now(), // Menggunakan waktu saat ini
        ]);

        // Menambahkan detail order untuk setiap item di cart
        Log::info('Isi item di CreateOrder ' . json_encode($this->cartItems, JSON_PRETTY_PRINT)); 
        foreach ($this->cartItems as $item) {
            $now = Carbon::now();
            $promo = $item['menu']['promo'];

            // Periksa apakah promo berlaku
            $hargaMenu = $item['menu']['harga'];
            if (
                $promo && 
                $promo['status'] === 'Aktif' &&
                ($promo['hari'] === 'AllDay' || $promo['hari'] === $now->format('l')) &&
                $now->between($promo['waktu_mulai'], $promo['waktu_berakhir'])
            ) {
                $hargaMenu = $promo['harga_promo'];
            }

            Log::info('Harga Menu (setelah promo): ' . json_encode(($hargaMenu), JSON_PRETTY_PRINT));
           
            $detailOrder = DetailOrder::create([
                'id_detailorder'=> 'DO-' .  Carbon::now()->format('YmdHis') . '-' . $count . '-' . $item['menu']['id_menu'],
                'id_order' => $order->id_order,
                'id_menu' => $item['menu']['id_menu'],
                'kuantitas' => $item['quantity'],
                'harga_menu' => $hargaMenu * $item['quantity'], // Harga Final
                'notes' => $item['notes'],  // Simpan notes
            ]);

           // Jika ada add-ons, buat DetailAddon
           if (!empty($item['addOn'])) { // Perbaikan key
            $this->createDetailAddon($detailOrder['id_detailorder'], $item['menu']['id_menu'], $item['addOn'], $item['quantity'], $item['menu']['harga']);
            }

            // **Pengurangan Stok**
            $menu = Menu::find($item['menu']['id_menu']); // Cari menu berdasarkan ID
            if ($menu && $menu->stock >= $item['quantity']) {
                $menu->decrement('stock', $item['quantity']); // Kurangi stok
            } else {
                throw new \Exception('Stok tidak mencukupi untuk menu ' . $item['menu']['nama_menu']);
            }

            $count++;
        
        }

        //Event Listener
        event(new PesananBaru($order));

        // Mengosongkan cart di session
        session()->forget('cart');
        $this->cartItems = [];
        $this->totalHarga = 0;

        return redirect()->route('order.successful', ['id_order' => $order->id_order]);
    }

    // Fungsi untuk membuat DetailAddon baru
    public function createDetailAddon($idDetailOrder, $idMenu, $addOns, $quantity, $menuHarga)
    {
        $count = 1;
        foreach ($addOns as $addon) {
            if ($addon['quantity'] > 0) {
                DetailAddon::create([
                    'id_detailaddon' => 'DA-'. Carbon::now()->format('YmdHis') . '-' .$count . '-'. $idMenu,
                    'id_addon' => $addon['id_addon'],
                    'id_detailorder' => $idDetailOrder,
                    'kuantitas' => $addon['quantity'],
                    'harga' => $addon['harga'] * $addon['quantity'], // Perhitungan harga
                ]);
            }
            $count++;
        }
    }

    private function checkEmpty()
    {
        if (empty($this->cartItems)) {
            return redirect()->route('order.menu', ['nomorMeja' => session('meja')]);
        }
    }


    public function render()
    {
        return view('livewire.checkout')
            ->title('Checkout'); 
    }
}
