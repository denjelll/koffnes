<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan Harian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1, h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            border: 1px solid #000;
        }

        tr.order-row td {
            border: 1px solid #000;
        }

        .footer {
            font-weight: bold;
            text-align: right;
        }

        .sub-detail {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Laporan Penjualan Harian</h1>
    <h2>Tanggal: {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY, HH:mm:ss') }}</h2>
    <h3>Dicetak oleh: {{ $printedBy }}</h3>

    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>No Antrian</th>
                <th>Nama Customer</th>
                <th>Cashier</th>
                <th>No Meja</th>
                <th>Tipe Order</th>
                <th>Status</th>
                <th>Metode Pembayaran</th> 
                <th>Waktu Transaksi</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPendapatan = 0;
            @endphp
            @foreach ($orders as $order)
                <tr class="order-row">
                    <td>{{ $order->id_order }}</td>
                    <td>{{ $order->antrian }}</td>
                    <td>{{ $order->customer }}</td>
                    <td>{{ $order->cashier->nama_depan . ' ' . $order->cashier->nama_belakang }}</td>
                    <td>{{ $order->meja }}</td>
                    <td>{{ $order->tipe_order }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->metode_pembayaran }}</td> 
                    <td>{{ $order->waktu_transaksi }}</td>
                    <td>Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                </tr>
                @php
                    $totalPendapatan += $order->total_harga;
                @endphp
                @foreach ($order->detailOrders as $detail)
                    <tr class="sub-detail">
                        <td colspan="3"></td>
                        <td colspan="3">{{ $detail->menu->nama_menu }}</td>
                        <td>Qty: {{ $detail->kuantitas }}</td>
                        <td colspan="1"></td>
                        <td>{{ number_format($detail->harga_menu * $detail->kuantitas, 0, ',', '.') }}</td>
                    </tr>
                    @foreach ($detail->detailAddon as $addon)
                        <tr class="sub-detail">
                            <td colspan="4"></td>
                            <td colspan="2">{{ $addon->addon->nama_addon }}</td>
                            <td>Qty: {{ $addon->kuantitas }}</td>
                            <td colspan="1"></td>
                            <td>{{ number_format($addon->harga * $addon->kuantitas, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="9" class="footer">Estimasi Pendapatan Hari Ini:</td>
                <td class="footer">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
