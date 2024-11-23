@extends('layouts.app')

@section('content')
<div>
    <h1>Laporan Penjualan (Closing)</h1>

    <form method="GET" action="{{ route('cashier.salesReport') }}">
        <div>
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" name="start_date" id="start_date" 
                   value="{{ isset($startDate) ? date('Y-m-d', strtotime($startDate)) : '' }}">
        </div>
        <div>
            <label for="end_date">Tanggal Akhir:</label>
            <input type="date" name="end_date" id="end_date" 
                   value="{{ isset($endDate) ? date('Y-m-d', strtotime($endDate)) : '' }}">
        </div>
        <div>
            <button type="submit">Filter</button>
        </div>
    </form>

    <div>
        <h2>Ringkasan Penjualan</h2>
        <p>
            <strong>Total Penjualan:</strong> Rp {{ number_format($totalSales, 0, ',', '.') }} <br>
            <strong>Rentang Waktu:</strong> 
            {{ isset($startDate) ? date('d-m-Y', strtotime($startDate)) : '' }} 
            hingga 
            {{ isset($endDate) ? date('d-m-Y', strtotime($endDate)) : '' }}
        </p>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>Antrian</th>
                <th>Customer</th>
                <th>Tipe Order</th>
                <th>Total Harga</th>
                <th>Waktu Transaksi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id_order }}</td>
                    <td>{{ $order->antrian }}</td>
                    <td>{{ $order->customer }}</td>
                    <td>{{ $order->tipe_order }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($order->waktu_transaksi)) }}</td>
                    <td>{{ $order->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Tidak ada data transaksi untuk rentang waktu ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
