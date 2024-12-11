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
            color: #333;
        }

        h1, h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            vertical-align: top;
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

        .detail {
            padding-left: 40px;
            text-align: right; /* Align ke kanan untuk detail order */
        }

        .right-align {
            text-align: right;
        }

        .table-summary td {
            padding-right: 15px;
            text-align: right;
        }

        .table-summary td:first-child {
            text-align: right;
        }

        .table-summary {
            margin-top: 20px;
            border-top: 2px solid #000;
            font-weight: bold;
        }

        tfoot tr.table-summary td {
            font-size: 16px;
            font-weight: bold;
            color: #222;
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
                <th>Meja</th>
                <th>Tipe Order</th>
                <th>Status</th>
                <th>Metode Pembayaran</th> 
                <th>Waktu Transaksi</th>
                <th>Bayar</th>
                <th>Kembalian</th>
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
                    <td class="right-align">Rp. {{ number_format($order->bayar, 0, ',', '.') }}</td>
                    <td class="right-align">Rp. {{ number_format($order->kembalian, 0, ',', '.') }}</td>
                    <td class="right-align">Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                </tr>
                @php
                    $totalPendapatan += $order->total_harga;
                @endphp
                @foreach ($order->detailOrders as $detail)
                    <tr class="sub-detail">
                        <td colspan="9" class="detail">{{ $detail->menu->nama_menu }}</td>
                        <td class="right-align">Qty: {{ $detail->kuantitas }}</td>
                        <td colspan="2" class="right-align">Rp. {{ number_format($detail->harga_menu * $detail->kuantitas, 0, ',', '.') }}</td>
                    </tr>
                    @foreach ($detail->detailAddon as $addon)
                        <tr class="sub-detail">
                            <td colspan="9" class="detail">+ {{ $addon->addon->nama_addon }}</td>
                            <td class="right-align">Qty: {{ $addon->kuantitas }}</td>
                            <td colspan="2" class="right-align">Rp. {{ number_format($addon->harga * $addon->kuantitas, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-summary">
                <td colspan="11 right-align">Estimasi Pendapatan Hari Ini:</td>
                <td class="right-align">Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
