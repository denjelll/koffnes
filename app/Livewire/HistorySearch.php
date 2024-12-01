<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class HistorySearch extends Component
{
    public $startDate;
    public $endDate;
    public $customerName;
    public $orders = [];
    public $totalTransaction = 0;
    public $isShowModalOpen = false;
    public $menuDetails = [];
    public $addOnDetails = [];
    public $totalHarga = 0;
    public $showDetails = [
        'menuItems' => [],
        'addOns' => [],
        'totalHarga' => 0,
        'orderId' => null
    ];

    public function search()
    {
        // Validasi input
        $this->validate([
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'customerName' => 'nullable|string|max:255',
        ]);

        // Query pencarian
        $query = Order::query()->where('status', 'Paid');

        if ($this->startDate) {
            $query->whereDate('waktu_transaksi', '>=', $this->startDate);
        }

        if ($this->endDate) {
            $query->whereDate('waktu_transaksi', '<=', $this->endDate);
        }

        if ($this->customerName) {
            $query->where('customer', 'like', '%' . $this->customerName . '%');
        }

        $query->orderBy('waktu_transaksi', 'asc');

        $this->orders = $query->get();

        $this->totalTransaction = $this->orders->sum('total_harga');
    }

    public function showOrders($id)
    {
        // Mengambil data order beserta detail menu dan add-ons
        $order = Order::with(['detailOrders.menu', 'detailOrders.addOns'])->find($id);

        if ($order) {
            // Siapkan detail menu dan harga
            $menuItems = $order->detailOrders->map(function ($detail) {
                return [
                    'nama_menu' => $detail->menu->nama_menu,
                    'kuantitas' => $detail->kuantitas,
                    'harga' => $detail->menu->harga, // Mengambil harga dari tabel menus
                    'total_harga' => $detail->kuantitas * $detail->menu->harga, // Menghitung total harga per menu
                ];
            });

            // Siapkan detail add-ons dan harga
            $addOns = $order->detailOrders->flatMap(function ($detail) {
                return $detail->addOns->map(function ($addon) {
                    return [
                        'nama_addon' => $addon->addon->nama_addon,
                        'kuantitas' => $addon->kuantitas,
                        'harga' => $addon->addon->harga, // Mengambil harga dari tabel add_ons
                        'total_harga' => $addon->kuantitas * $addon->addon->harga, // Menghitung total harga per add-on
                    ];
                });
            });

            // Menghitung total harga untuk menu dan add-ons
            $totalHarga = $menuItems->sum('total_harga') + $addOns->sum('total_harga');

            $this->showDetails = [
                'menuItems' => $menuItems->toArray(),
                'addOns' => $addOns->toArray(),
                'totalHarga' => $totalHarga,
                'orderId' => $order->id_order,
            ];

            // Membuka modal approve
            $this->isShowModalOpen = true;
        }
    }

    public function render()
    {
        return view('livewire.history-search')
            ->title('History Transaksi');
    }
}
