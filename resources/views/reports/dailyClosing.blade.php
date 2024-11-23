<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report Harian</title>
</head>
<body>
    <h1>Laporan Penjualan Harian</h1>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>No Antrian</th>
            <th>Nama Customer</th>
            <th>Nama Cashier</th>
            <th>No Meja</th>
            <th>Tipe Order</th>
            <th>Status</th>
            <th>Harga Total</th>
            <th>Waktu Transaksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id_order }}</td>
            <td>{{ $order->antrian }}</td>
            <td>{{ $order->customer }}</td>
            <td>{{ $order->cashier }}</td>
            <td>{{ $order->meja }}</td>
            <td>{{ $order->tipe_order }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ number_format($order->total_harga, 0, ',', '.') }}</td>
            <td>{{ $order->waktu_transaksi }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>