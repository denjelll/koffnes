<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExportByID implements FromCollection, WithHeadings
{
    protected $id_order;

    public function __construct($id_order)
    {
        $this->id_order = $id_order;
    }

    public function collection()
    {
        $order = Order::with(['detailOrders.menu', 'detailOrders.detailAddon.addon', 'cashier'])
                      ->where('id_order', $this->id_order)
                      ->first();
        
        $data = [];
        foreach ($order->detailOrders as $detail) {
            if ($detail->detailAddon->isEmpty()) {
                $data[] = [
                    'Tanggal Transaksi' => $order->waktu_transaksi,
                    'ID Order' => $order->id_order,
                    'Nama Customer' => $order->customer,
                    'Nomor Meja' => $order->meja,
                    'Tipe Order' => $order->tipe_order,
                    'Kasir' => $order->cashier->nama,
                    'Nama Menu' => $detail->menu->nama_menu,
                    'Kuantitas' => $detail->kuantitas,
                    'Harga' => $detail->menu->harga,
                    'Nama Addon' => '',
                    'Kuantitas Add On' => '',
                    'Harga Add On' => ''
                ];
            } else {
                foreach ($detail->detailAddon as $addon) {
                    $data[] = [
                        'Tanggal Transaksi' => $order->waktu_transaksi,
                        'ID Order' => $order->id_order,
                        'Nama Customer' => $order->customer,
                        'Nomor Meja' => $order->meja,
                        'Tipe Order' => $order->tipe_order,
                        'Kasir' => $order->cashier->nama,
                        'Nama Menu' => $detail->menu->nama_menu,
                        'Kuantitas' => $detail->kuantitas,
                        'Harga' => $detail->menu->harga,
                        'Nama Addon' => $addon->addon->nama_addon,
                        'Kuantitas Add On' => $addon->kuantitas,
                        'Harga Add On' => $addon->harga
                    ];
                }
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Tanggal Transaksi',
            'ID Order',
            'Nama Customer',
            'Nomor Meja',
            'Tipe Order',
            'Kasir',
            'Nama Menu',
            'Kuantitas',
            'Harga',
            'Nama Addon',
            'Kuantitas Add On',
            'Harga Add On'
        ];
    }
}
