<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class Dashboard extends Component
{
    public $currentTab = 'Open Bill';
    public $orders = [];
    public function mount()
    {
        $this->updateOrders();
    }

    public function switchTab($tab)
    {
        $this->currentTab = $tab;
        $this->updateOrders();
    }

    private function updateOrders()
    {
        $this->orders = Order::where('status', $this->currentTab)->get();
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'currentTab' => $this->currentTab,
            'orders' => $this->orders
        ]);
    }
}
