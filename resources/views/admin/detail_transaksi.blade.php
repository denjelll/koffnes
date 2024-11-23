@extends('layout.admin_navbar')
@section('title')
    Transaction Detail
@endsection
@section('content')
<p>Tanggal Transaksi : {{date('d F Y', strtotime($order->waktu_transaksi))}}</p>
<p>ID Order : {{$order->id_order}}</p>
<p>Nama Customer : {{$order->customer}}</p>
<p>Nomor Meja : {{$order->meja}}</p>
<p>Tipe Order : {{$order->tipe_order}}</p>
<p>Kasir : {{$order->cashier->nama}}</p>
<table>
    <tr>
        <th>Nama Menu</th>
        <th>Jumlah</th>
        <th>Harga</th>
        <th>Subtotal</th>
    </tr>
@php
    $totalHarga = 0;
@endphp
@foreach ($order->detailOrders as $detail)
    @php
        $subtotal = $detail->menu->harga * $detail->kuantitas;
        $totalHarga += $subtotal;
    @endphp
    <tr class="bg-cocoa-100 border-b">
        <td>{{$detail->menu->nama_menu}}</td>
        <td>{{$detail->kuantitas}}</td>
        <td>Rp{{number_format($detail->menu->harga, 0, ',', '.')}}</td>
        <td>Rp{{number_format($subtotal, 0, ',', '.')}}</td>
    </tr>
    @if ($detail->detailAddon != null)
        <tr>
            <th colspan="4">Addons</th>
        </tr>
        @foreach ($detail->detailAddon as $addon)
            @php
                $addonSubtotal = $addon->addon->harga * $addon->kuantitas;
                $totalHarga += $addonSubtotal;
            @endphp
            <tr>
                <td>{{$addon->addon->nama_addon}}</td>
                <td>{{$addon->kuantitas}}</td>
                <td>Rp{{number_format($addon->addon->harga, 0, ',', '.')}}</td>
                <td>Rp{{number_format($addonSubtotal, 0, ',', '.')}}</td>
            </tr>
        @endforeach
    @endif
@endforeach
<tr>
    <td colspan="3">Total Harga</td>
    <td>Rp{{number_format($totalHarga, 0, ',', '.')}}</td>
</tr>
</table>
@endsection