@extends('layout.admin_navbar')
@section('title')
    Transaction Detail
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Transaction Detail
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <p class="text-gray-700"><strong>Tanggal Transaksi:</strong> {{ date('d F Y', strtotime($order->waktu_transaksi)) }}</p>
            <p class="text-gray-700"><strong>ID Order:</strong> {{ $order->id_order }}</p>
            <p class="text-gray-700"><strong>Nama Customer:</strong> {{ $order->customer }}</p>
            <p class="text-gray-700"><strong>Nomor Meja:</strong> {{ $order->meja }}</p>
            <p class="text-gray-700"><strong>Tipe Order:</strong> {{ $order->tipe_order }}</p>
            <p class="text-gray-700"><strong>Kasir:</strong> {{ $order->cashier->nama }}</p>
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-center">
                <thead class="bg-[#412f26] text-white">
                    <tr>
                        <th class="p-4">Nama Menu</th>
                        <th class="p-4">Kuantitas</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-[#f1e8d4] text-black">
                    @php
                        $totalHarga = 0;
                    @endphp
                    @foreach ($order->detailOrders as $detail)
                        @php
                            $subtotal = $detail->menu->harga * $detail->kuantitas;
                            $totalHarga += $subtotal;
                        @endphp
                        <tr class="border-b border-gray-300">
                            <td class="p-4">{{ $detail->menu->nama_menu }}</td>
                            <td class="p-4">{{ $detail->kuantitas }}</td>
                            <td class="p-4">Rp{{ number_format($detail->menu->harga, 0, ',', '.') }}</td>
                            <td class="p-4">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @if ($detail->detailAddon != null)
                            <tr class="bg-[#412f26] text-white">
                                <th colspan="4" class="p-4">Addons</th>
                            </tr>
                            @foreach ($detail->detailAddon as $addon)
                                @php
                                    $addonSubtotal = $addon->addon->harga * $addon->kuantitas;
                                    $totalHarga += $addonSubtotal;
                                @endphp
                                <tr class="border-b border-gray-300 bg-[#a36f55] text-white">
                                    <td class="p-4">{{ $addon->addon->nama_addon }}</td>
                                    <td class="p-4">{{ $addon->kuantitas }}</td>
                                    <td class="p-4">Rp{{ number_format($addon->addon->harga, 0, ',', '.') }}</td>
                                    <td class="p-4">Rp{{ number_format($addonSubtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            <p class="text-xl font-semibold text-gray-700"><strong>Total Harga:</strong> Rp{{ number_format($totalHarga, 0, ',', '.') }}</p>
        </div>
    </div>
</div>
@endsection