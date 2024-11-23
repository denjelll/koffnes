<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;

class TotalHarga extends Component
{
    public $totalHarga = 0;
 
    protected $listeners = ['updateTotalHarga' => 'calculateTotal'];

    public function mount()
    {
        // Hitung total harga saat pertama kali dimuat
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $cart = session('cart', []);
        $this->totalHarga = 0;

        foreach ($cart as $item) {
            $menu = Menu::find($item['id_menu']);
            if ($menu) {
                $this->totalHarga += $menu->harga * $item['quantity'];
            }
        }
    }

    public function render()
    {
        return view('livewire.total-harga');
    }
}
