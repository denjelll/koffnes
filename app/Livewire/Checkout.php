<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Menu;
use App\Models\PaketAddon;
use App\Models\Order;
use App\Models\DetailOrder;

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
        }

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        // Menghitung total harga berdasarkan kuantitas dan harga menu
        $total = 0;
        foreach ($this->cartItems as $item) {
            $total += $item['quantity'] * $item['menu']->harga;
        }
        $this->totalHarga = $total;
    }

    public function updateCartItem($idMenu, $quantity, $notes = null, $selectedAddOn = null)
    {
        // Menemukan item di cart berdasarkan id_menu
        $index = array_search($idMenu, array_column($this->cartItems, 'menu_id'));
        if ($index !== false) {
            $this->cartItems[$index]['quantity'] = $quantity;
            $this->cartItems[$index]['notes'] = $notes;
            $this->cartItems[$index]['selectedAddOn'] = $selectedAddOn;
        }

        // Update session cart
        session()->put('cart', $this->cartItems);

        // Hitung ulang total harga
        $this->calculateTotal();
    }

    public function createOrder()
    {
        // Membuat order baru
        $order = Order::create([
            'status' => 'Pending', // Bisa disesuaikan
            'total' => $this->totalHarga,
        ]);

        // Menambahkan detail order untuk setiap item di cart
        foreach ($this->cartItems as $item) {
            $detailOrder = DetailOrder::create([
                'order_id' => $order->id,
                'menu_id' => $item['menu']->id_menu,
                'quantity' => $item['quantity'],
                'price' => $item['menu']->harga,
                'notes' => $item['notes'],
                'addon_id' => $item['selectedAddOn'] ?? null,
            ]);
        }

        // Mengosongkan cart di session
        session()->forget('cart');
        $this->cartItems = [];
        $this->totalHarga = 0;

        // Redirect ke halaman sukses atau halaman lain
        return redirect()->route('order.success');
    }

    public function render()
    {
        // Menyertakan add-ons berdasarkan paket_addon yang terkait dengan menu
        foreach ($this->cartItems as &$item) {
            $item['addOns'] = PaketAddon::with('addon')
                ->where('id_menu', $item['menu']->id_menu)
                ->get()
                ->pluck('addon');
        }

        return view('livewire.checkout');
    }
}

