<?php

namespace App\Livewire;

use Livewire\Component;

class TotalHarga extends Component
{
    public $totalHarga = 0;
    public $itemQuantities = []; 

    protected $listeners = ['updateTotalHarga' => 'updateHarga'];

    public function updateHarga($data)
    {
        // Data will include menuId and quantity from the MenuItem component
        $menuId = $data['menuId'];
        $quantity = $data['quantity'];
        $price = $data['price']; // Assume `price` is also passed from the MenuItem component

        // Update the quantity for the specific item in the array
        $this->itemQuantities[$menuId] = [
            'quantity' => $quantity,
            'price' => $price
        ];

        // Recalculate totalHarga
        $this->calculateTotalHarga();
    }

    private function calculateTotalHarga()
    {
        $this->totalHarga = 0; // Reset totalHarga

        foreach ($this->itemQuantities as $item) {
            $this->totalHarga += $item['quantity'] * $item['price'];
        }
    }

    public function render()
    {
        return view('livewire.total-harga');
    }
}
