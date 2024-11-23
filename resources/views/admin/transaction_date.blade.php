@extends('layout.admin_navbar')
@section('title')
    Transaction Recap

@endsection
@section('content')
@if ($orders->isEmpty())
    <p>No transaction found.</p>

@else
<table>
    <tr>
        <th>Tanggal</th>
        <th>ID Order</th>
        <th>Nama Customer</th>
        <th>Nomor Meja</th>
        <th>Tipe Order</th>
        <th>Total Harga</th>
        <th>Status</th>
        <th>Detail</th>
    </tr>
    @foreach ($orders as $order)
    <tr>
        <td>{{ date('d F Y', strtotime($order->waktu_transaksi)) }}</td>
        <td>{{ $order->id_order }}</td>
        <td>{{ $order->customer }}</td>
        <td>{{ $order->meja }}</td>
        <td>{{ $order->tipe_order }}</td>
        <td>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
        <td>{{ $order->status }}</td>
        <td><a href="{{route('admin.detail_transaction', $order->id_order)}}">View Detail</a></td>
    </tr>
    @endforeach
</table>
@endif
@endsection