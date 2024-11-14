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
        $this->dispatch('updateTotalHarga', [
            'menuId' => $this->menu->id_menu,
            'quantity' => $this->quantity,
            'price' => $this->menu->harga
        ]);
    }

    public function decrement()
    {
        if ($this->quantity > 0) {
            $this->quantity--;
            $this->dispatch('updateTotalHarga', [
                'menuId' => $this->menu->id_menu,
                'quantity' => $this->quantity,
                'price' => $this->menu->harga
            ]);
        }
    }

    public function render()
    {
        return view('livewire.menu-item');
    }
}

