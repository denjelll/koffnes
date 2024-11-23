<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class Dashboard extends Component
{
    public $currentTab = 'Open Bill';
    public $orders = [];
    public $isModalOpen = false;
    public $menuItems = [];
    public $quantities = [];
    public $totalPrices = []; // Menyimpan total harga per menu item
    public $selectedOrder;
    public function mount()
    {
        $this->updateOrders();
    }

    public function switchTab($tab)
    {
        $this->currentTab = $tab;
        $this->updateOrders();
    }

    public function approveOrder($id)
    {
        $order = Order::find($id);
        if($order && $order->status === 'Open Bill') {
            $order->update(['status' => 'Paid']);
            $this->updateOrders();
        }
    }

    public function editOrder($orderId)
    {
        $order = Order::with('detailOrders.menu')->find($orderId);

        if ($order) {
            $this->menuItems = $order->detailOrders;

            // Menyimpan kuantitas dan harga berdasarkan detail order
            foreach ($this->menuItems as $item) {
                $this->quantities[$item->id_menu] = $item->kuantitas;
                $this->totalPrices[$item->id_menu] = $item->harga_menu * $item->kuantitas; // Menghitung total harga
            }

            $this->selectedOrder = $order;

            // Menampilkan modal untuk edit order
            $this->isModalOpen = true;
        }
    }

    public function cancelOrder($id)
    {
        $order = Order::find($id);
        if($order && $order->status === 'Open Bill') {
            $order->update(['status' => 'Cancelled']);
            $order->delete(); // Melakukan soft delete
            $this->updateOrders();
        }
    }

    public function saveOrder()
    {
        // Hitung total harga seluruh item di order ini
        $totalHarga = 0;

        // Update kuantitas dan harga setiap menu
        foreach ($this->menuItems as $item) {
            $item->update([
                'kuantitas' => $this->quantities[$item->id_menu] ?? $item->kuantitas,
                'harga_menu' => $item->harga_menu * ($this->quantities[$item->id_menu] ?? 1), // Update harga_menu
            ]);

            // Menambahkan harga per item ke total harga
            $totalHarga += $item->harga_menu * $item->kuantitas;
        }

        // Update total_harga di tabel orders
        $this->selectedOrder->update([
            'total_harga' => $totalHarga
        ]);

        $this->isModalOpen = false;
    }

    public function increaseQuantity($id_menu)
    {
        if (isset($this->quantities[$id_menu])) {
            $this->quantities[$id_menu]++;
            $this->updatePrice($id_menu); // Update harga saat kuantitas bertambah
            $this->updateOrderTotal(); // Update total harga order
        }
    }

    public function decreaseQuantity($id_menu)
    {
        if (isset($this->quantities[$id_menu]) && $this->quantities[$id_menu] > 1) {
            $this->quantities[$id_menu]--;
            $this->updatePrice($id_menu); // Update harga saat kuantitas berkurang
            $this->updateOrderTotal(); // Update total harga order
        }
    }

    // Fungsi untuk menghitung ulang harga berdasarkan kuantitas
    private function updatePrice($id_menu)
    {
        $item = $this->menuItems->firstWhere('id_menu', $id_menu);
        if ($item) {
            $this->totalPrices[$id_menu] = $item->harga_menu * $this->quantities[$id_menu];
        }
    }

    // Fungsi untuk mengupdate total harga pada tabel orders
    private function updateOrderTotal()
    {
        $totalHarga = 0;
        foreach ($this->menuItems as $item) {
            $totalHarga += $item->harga_menu * $this->quantities[$item->id_menu];
        }

        // Update total harga pada order
        $this->selectedOrder->update([
            'total_harga' => $totalHarga
        ]);
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
