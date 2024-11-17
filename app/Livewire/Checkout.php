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
            $item['quantity'] = $item['quantity'] ?? 1; // Default kuantitas jika tidak ada
            $item['notes'] = $item['notes'] ?? '';      // Default notes kosong jika tidak ada

            // Ambil add-ons terkait menu
            if ($item['menu']) {
                $item['addOn'] = $item['menu']->addOns()->get()->map(function ($addon) {
                    return [
                        'id_addon' => $addon->id_addon,
                        'nama_addon' => $addon->nama_addon,
                        'harga' => $addon->harga,
                        'quantity' => 0, // Set kuantitas awal ke 0
                    ];
                })->toArray();
            } else {
                $item['addOn'] = [];
            }
        }

        Log::info('Item after fetching add-ons: ' . json_encode($item, JSON_PRETTY_PRINT)); 
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

    public function updateAddonQuantity($menuId, $addonId, $action)
    {
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
            'id_user' => 'NOT PICK UP', // Kosongkan karena akan diisi oleh kasir nanti
            'antrian' => $antrian,
            'customer' => session('nama_customer'),
            'meja' => session('meja'),
            'tipe_order' => 'Dine In',
            'status' => 'Open Bill',
            'total_harga' => $this->totalHarga,
            'waktu_transaksi' => now(), // Menggunakan waktu saat ini
        ]);

        // Menambahkan detail order untuk setiap item di cart
        Log::info('Isi item di CreateOrder ' . json_encode($this->cartItems, JSON_PRETTY_PRINT)); 
        foreach ($this->cartItems as $item) {
            Log::info('ID_Menu ' . json_encode($item['menu']['id_menu'], JSON_PRETTY_PRINT)); 

            $detailOrder = DetailOrder::create([
                'id_detailorder'=> 'DO' . Str::uuid(),
                'id_order' => $order->id_order,
                'id_menu' => $item['menu']['id_menu'],
                'kuantitas' => $item['quantity'],
                'harga_menu' => $item['menu']['harga'] * $item['quantity'],
                'notes' => $item['notes'],  // Simpan notes
            ]);

           // Jika ada add-ons, buat DetailAddon
           if (!empty($item['addOn'])) { // Perbaikan key
            $this->createDetailAddon($detailOrder['id_detailorder'], $item['addOn'], $item['quantity'], $item['menu']['harga']);
            }
        
        }

        // Mengosongkan cart di session
        session()->forget('cart');
        $this->cartItems = [];
        $this->totalHarga = 0;

        return redirect()->route('order.successful', ['nomorMeja' => session('meja'), 'id_order' => $order->id_order]);
    }

    // Fungsi untuk membuat DetailAddon baru
    public function createDetailAddon($idDetailOrder, $addOns, $quantity, $menuHarga)
    {
        foreach ($addOns as $addon) {
            if ($addon['quantity'] > 0) {
                DetailAddon::create([
                    'id_detailaddon' => Str::random(10),
                    'id_addon' => $addon['id_addon'],
                    'id_detailorder' => $idDetailOrder,
                    'kuantitas' => $addon['quantity'],
                    'harga' => $addon['harga'] * $addon['quantity'], // Perhitungan harga
                ]);
            }
        }
    }


    public function render()
    {
        return view('livewire.checkout')
            ->title('Checkout'); 
    }
}
