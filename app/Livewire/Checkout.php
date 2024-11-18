<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Menu;

use App\Models\Order;
use Livewire\Component;
use App\Models\PaketAddon;
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
    
        // Ambil detail menu berdasarkan id_menu untuk setiap item di cart
        foreach ($this->cartItems as &$item) {
            $item['menu'] = Menu::find($item['id_menu']); // Ambil menu berdasarkan id_menu
            $item['quantity'] = $item['quantity'] ?? 1; // Pastikan ada nilai default untuk kuantitas
            $item['notes'] = $item['notes'] ?? '';      // Pastikan notes kosong jika tidak ada
           
            // Ambil add-ons terkait menu, jika ada
             if ($item['menu']) {
                $item['addOn'] = $item['menu']->addOns()->get(); // Ambil add-on terkait
            } else {
                $item['addOn'] = collect(); // Koleksi kosong jika menu tidak ditemukan
            }

            Log::info('Add-ons for Menu ' . $item['id_menu'], $item['addOn']->toArray()); 
            $item['selectedAddOn'] = $item['selectedAddOn'] ?? null; // Default null
        }
    
        // Hitung total harga awal
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->totalHarga = 0;

        foreach ($this->cartItems as $item) {
            $this->totalHarga += $item['menu']->harga * $item['quantity'];

            if (!empty($item['addOn'])) {
                foreach ($item['addOn'] as $addon) {
                    $this->totalHarga += $addon->harga * ($addon->quantity ?? 0); // Perhitungan harga add-on
                }
            }
        }
    }

    

    public function updateMenuQuantity($idMenu, $quantity)
    {
        foreach ($this->cartItems as &$item) {
            if ($item['menu']->id_menu === $idMenu) {
                $item['quantity'] = max(0, (int)$quantity); // Validasi kuantitas tidak boleh kurang dari 0
                break;
            }
        }

        // Update session cart
        session()->put('cart', $this->cartItems);

        // Hitung ulang total harga
        $this->calculateTotal();
    }

    public function validateQuantity($idMenu, $quantity)
    {
        // Pastikan kuantitas adalah angka valid >= 0
        $quantity = max(0, (int)$quantity);

        // Temukan indeks item di cart berdasarkan idMenu
        $index = array_search($idMenu, array_column($this->cartItems, 'menu.id_menu'));

        if ($index !== false) {
            $this->cartItems[$index]['quantity'] = $quantity;

            // Hapus item jika kuantitas 0
            if ($quantity == 0) {
                unset($this->cartItems[$index]);
            }

            // Update session cart
            session()->put('cart', $this->cartItems);

            // Hitung ulang total harga
            $this->calculateTotal();
        }
    }

    public function updateAddonQuantity($idMenu, $idAddon, $quantity)
    {
        foreach ($this->cartItems as &$item) {
            // Cari item menu yang sesuai
            if ($item['menu']->id_menu === $idMenu) {
                // Cari add-on dalam menu tersebut
                foreach ($item['addOn'] as &$addon) {
                    if ($addon->id_addon === $idAddon) {
                        $addon->quantity = max(0, (int)$quantity); // Validasi kuantitas >= 0
                        break;
                    }
                }
                break;
            }
        }
    
        // Update session cart
        session()->put('cart', $this->cartItems);
    
        // Hitung ulang total harga
        $this->calculateTotal();
    }




    public function createOrder()
    {
        $today = Carbon::today();

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
            'id_order' => 'ORD' . strrev(Carbon::now()->format('YmdHis')) . $antrian,
            'id_user' => null, // Kosongkan karena akan diisi oleh kasir nanti
            'antrian' => $antrian,
            'customer' => session('nama_customer'),
            'meja' => session('meja'),
            'tipe_order' => 'Dine In',
            'status' => 'Open Bill',
            'total_harga' => $this->totalHarga,
            'waktu_transaksi' => now(), // Menggunakan waktu saat ini
        ]);

        // Menambahkan detail order untuk setiap item di cart
        foreach ($this->cartItems as $item) {
            $detailOrder = DetailOrder::create([
                'id_detailorder'=> 'DO' . Str::uuid(),
                'id_order' => $order->id_order,
                'menu_id' => $item['menu']->id_menu,
                'quantity' => $item['quantity'],
                'price' => $item['menu']->harga,
                'notes' => $item['notes'],  // Simpan notes
                'addon_id' => $item['selectedAddOn'] ?? null,  // Simpan addon yang dipilih
            ]);

           // Jika ada add-ons, buat DetailAddon
            if ($item['selectedAddOn']) {
                $this->createDetailAddon($detailOrder->id, $item['selectedAddOn'], $item['quantity'], $item['menu']->harga);
            }
        }

        // Mengosongkan cart di session
        session()->forget('cart');
        $this->cartItems = [];
        $this->totalHarga = 0;

        // Redirect ke halaman sukses atau halaman lain
        return redirect()->route('/');
    }

    // Fungsi untuk membuat DetailAddon baru
    public function createDetailAddon($idDetailOrder, $idAddon, $quantity, $harga)
    {
        // Mengecek apakah detail addon sudah ada
        $existingAddon = DetailAddon::where('id_detailorder', $idDetailOrder)
                                    ->where('id_addon', $idAddon)
                                    ->first();

        if ($existingAddon) {
            // Jika sudah ada, update kuantitas dan harga
            $existingAddon->update([
                'kuantitas' => $existingAddon->kuantitas + $quantity,
                'harga' => $harga * $existingAddon->kuantitas,
            ]);
        } else {
            // Jika belum ada, buat DetailAddon baru
            DetailAddon::create([
                'id_detailaddon' => Str::uuid(), // Gunakan UUID atau ID lainnya yang sesuai
                'id_addon' => $idAddon,
                'id_detailorder' => $idDetailOrder,
                'kuantitas' => $quantity,
                'harga' => $harga * $quantity,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.checkout')
            ->title('Checkout'); 
    }
}
