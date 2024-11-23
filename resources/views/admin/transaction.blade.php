@extends('layout.admin_navbar')
@section('title')
    Transaction Recap

@endsection
@section('content')
<table>
    <tr>
        <th>Tanggal</th>
        <th>Jumlah Pendapatan</th>
        <th>Detail</th>
    </tr>
    @foreach ($orders as $order)
    <tr>
        <td>{{ date('d F Y', strtotime($order->date)) }}</td>
        <td>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
        <td><a href="{{ route('admin.transaction.date', ['date' => $order->date]) }}">View Detail</a></td>
    </tr>
    @endforeach
</table>
@endsection