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

    public function render()
    {
        return view('livewire.history-search')
            ->title('History Transaksi');
    }
}
