<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class Dashboard extends Component
{
    public $currentTab = 'Open Bill';

    //Data Pesanan
    public $orders = [];
    public $selectedOrder;

    //Data Menu Utama
    public $menuItems = [];
    public $quantities = [];
    public $totalPrices = [];

    //Data Add-Ons
    public $addOns = [];
    public $addonQuantities = [];

    //Pop Up Variable
    public $isModalOpen = false;
    

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
        $order = Order::with(['detailOrders.menu', 'detailOrders.addOns'])->find($orderId);

        if ($order) {
            // Ambil detail order dan addons
            $this->menuItems = $order->detailOrders; // Menu utama
            foreach ($this->menuItems as $item) {
                $this->quantities[$item->id_detailorder] = $item->kuantitas;
                $this->totalPrices[$item->id_detailorder] = $item->harga_menu * $item->kuantitas;
            }

            $this->addOns = $order->detailOrders->flatMap(function ($detailOrder) {
                return $detailOrder->addOns;
            });

            foreach ($this->addOns as $addon) {
                $this->addonQuantities[$addon->id_detailaddon] = $addon->kuantitas;
            }

            $this->selectedOrder = $order;
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
        $totalHarga = 0;

        // Update menu utama
        foreach ($this->menuItems as $menu) {
            $detailOrder = $menu->find($menu->id_detailorder);
            if ($detailOrder) {
                $kuantitas = $this->quantities[$menu->id_detailorder] ?? $menu->kuantitas;
                $hargaMenu = $menu->menu->harga;

                $detailOrder->update([
                    'kuantitas' => $kuantitas,
                    'harga_menu' => $hargaMenu,
                ]);

                $totalHarga += $hargaMenu * $kuantitas;
            }
        }

        // Update addons
        foreach ($this->addOns as $addon) {
            $detailAddon = $addon->find($addon->id_detailaddon);
            if ($detailAddon) {
                $kuantitas = $this->addonQuantities[$addon->id_detailaddon] ?? $addon->kuantitas;
                $hargaAddon = $addon->addon->harga;

                $detailAddon->update([
                    'kuantitas' => $kuantitas,
                    'harga' => $hargaAddon,
                ]);

                $totalHarga += $hargaAddon * $kuantitas;
            }
        }

        // Update total harga di tabel orders
        $this->selectedOrder->update([
            'total_harga' => $totalHarga,
        ]);

        $this->isModalOpen = false;
        $this->updateOrders();
    }

    public function increaseQuantity($id_detailorder)
    {
        
        if (isset($this->quantities[$id_detailorder])) {
            $this->quantities[$id_detailorder]++;
            $this->updatePrice($id_detailorder); // Update harga saat kuantitas bertambah
            $this->updateOrderTotal(); // Update total harga order
        }
    }

    public function decreaseQuantity($id_detailorder)
    {
        if (isset($this->quantities[$id_detailorder]) && $this->quantities[$id_detailorder] > 1) {
            $this->quantities[$id_detailorder]--;
            $this->updatePrice($id_detailorder); // Update harga saat kuantitas berkurang
            $this->updateOrderTotal(); // Update total harga order
        }
    }

    public function increaseAddonQuantity($id_addon)
    {
        if (isset($this->addonQuantities[$id_addon])) {
            $this->addonQuantities[$id_addon]++;
            $this->updateAddonPrice($id_addon); // Update harga saat kuantitas bertambah
            $this->updateOrderTotal(); // Update total harga order
        }
    }

    public function decreaseAddonQuantity($id_addon)
    {
        if (isset($this->addonQuantities[$id_addon]) && $this->addonQuantities[$id_addon] > 1) {
            $this->addonQuantities[$id_addon]--;
            $this->updateAddonPrice($id_addon); // Update harga saat kuantitas berkurang
            $this->updateOrderTotal(); // Update total harga order
        }
    }

    private function updateAddonPrice($id_addon)
    {
        $addon = $this->addOns->firstWhere('id_detailaddon', $id_addon); // ID tetap berupa string
        if ($addon) {
            $this->totalPrices[$id_addon] = $addon->addon->harga * $this->addonQuantities[$id_addon];
        }
    }


    // Fungsi untuk menghitung ulang harga berdasarkan kuantitas
    private function updatePrice($id_detailorder)
    {
        $item = $this->menuItems->firstWhere('id_detailorder', $id_detailorder);
        if ($item) {
            $this->totalPrices[$id_detailorder] = $item->harga_menu * $this->quantities[$id_detailorder];
        }
    }

    // Fungsi untuk mengupdate total harga pada tabel orders
    private function updateOrderTotal()
    {
        $totalHarga = 0;
        foreach ($this->menuItems as $item) {
            $totalHarga += $item->harga_menu * $this->quantities[$item->id_detailorder];
        }

        // Hitung total harga dari add-ons
        foreach ($this->addOns as $addon) {
            $totalHarga += $addon->addon->harga * $this->addonQuantities[$addon->id_detailaddon];
        }

        // Update total harga pada order
        if ($this->selectedOrder) {
            $this->selectedOrder->update([
                'total_harga' => $totalHarga,
            ]);
        }
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
