<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - {{ $order->id_order }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .receipt {
            width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .items table {
            width: 100%;
            border-collapse: collapse;
        }
        .items table th, .items table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h2>Receipt</h2>
            <p>ID Order: {{ $order->id_order }}</p>
            <p>Date: {{ $order->waktu_transaksi }}</p>
        </div>
        <div class="items">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{ $detail->nama_menu }}</td>
                            <td>{{ $detail->kuantitas }}</td>
                            <td>{{ number_format($detail->harga * $detail->kuantitas, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="total">
            <h3>Total: Rp {{ number_format($totalHarga, 2) }}</h3>
        </div>
    </div>
</body>
</html>
