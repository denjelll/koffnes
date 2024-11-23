<?php

namespace App\Livewire;

use Livewire\Component;

class MenuItem extends Component
{
    public $menu;
    public $quantity = 0;

    public function mount()
    {
        // Ambil cart dari session
        $cart = session('cart', []);

        // Set kuantitas berdasarkan cart
        $this->quantity = $cart[$this->menu->id_menu]['quantity'] ?? 0;
    }

    public function increment()
    {
        $this->quantity++;
        $this->updateCart();
    }

    public function decrement()
    {
        if ($this->quantity > 0) {
            $this->quantity--;
            $this->updateCart();
        }
    }

    private function updateCart()
{
    // Ambil cart dari session
    $cart = session('cart', []);

    // Jika kuantitas > 0, perbarui atau tambahkan item ke dalam cart
    if ($this->quantity > 0) {
        // Perbarui atau tambahkan item ke dalam cart
        $cart[$this->menu->id_menu] = [
            'id_menu' => $this->menu->id_menu,
            'quantity' => $this->quantity,
        ];
    } else {
        // Hapus item dari cart jika kuantitasnya 0
        unset($cart[$this->menu->id_menu]);
    }

    // Simpan kembali ke session
    session(['cart' => $cart]);

    // Dispatch event untuk update total harga
    $this->dispatch('updateTotalHarga');
}


    public function render()
    {
        return view('livewire.menu-item');
    }
}
