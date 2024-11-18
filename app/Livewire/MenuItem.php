<?php

namespace App\Livewire;

use Livewire\Component;

class MenuItem extends Component
{
    public $menu;
    public $quantity = 0;

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

        if ($this->quantity > 0) {
            // Perbarui atau tambahkan item ke dalam cart
            $cart[$this->menu->id_menu] = [
                'id_menu' => $this->menu->id_menu,
                'quantity' => $this->quantity,
            ];
        } else {
            // Jika kuantitas 0, hapus item dari cart
            unset($cart[$this->menu->id_menu]);
        }

        // Simpan kembali ke session
        session(['cart' => $cart]);

        // Dispatch event ke komponen total harga
        $this->dispatch('updateTotalHarga', [
            'menuId' => $this->menu->id_menu,
            'quantity' => $this->quantity,
            'price' => $this->menu->harga,
        ]);
        
    }

    public function render()
    {
        return view('livewire.menu-item');
    }
}
