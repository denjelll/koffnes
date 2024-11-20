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

    public function approveOrder($id)
    {
        $order = Order::find($id);
        if($order && $order->status === 'Open Bill') {
            $order->update(['status' => 'Paid']);
            $this->updateOrders();
        }
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);
        if($order && $order->status === 'Open Bill') {
            $order->update(['status' => 'Cancelled']);
            $this->updateOrders();
        }
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'currentTab' => $this->currentTab,
            'orders' => $this->orders
        ]);
    }
}
