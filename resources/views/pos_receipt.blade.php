<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran</title>
    <style>
        /* Ukuran kertas 58mm x 45mm */
        @page {
            size: 58mm 45mm;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }
        .receipt {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            text-align: center;
        }
        .header {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .line {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .details {
            text-align: left;
        }
        .details .item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <!-- Header -->
        <div class="header">
            <div>KAFE ANDA</div>
            <div>Jalan Cafe No. 58</div>
            <div>Indonesia</div>
        </div>
        <div class="line"></div>

        <!-- Info Transaksi -->
        <div class="details">
            <div class="item">
                <span>Tanggal:</span>
                <span>{{ $order->waktu_transaksi }}</span>
            </div>
            <div class="item">
                <span>Cashier:</span>
                <span>{{ $cashier->nama_depan }} {{ $cashier->nama_belakang }}</span>
            </div>
            <div class="item">
                <span>Metode Pembayaran:</span>
                <span>{{ $order->metode_pembayaran }}</span>
            </div>
        </div>
        <div class="line"></div>

        <!-- Detail Pesanan -->
        <div class="details">
            @foreach ($order->detailOrders as $detail)
                <div class="item">
                    <span>{{ $detail->menu->nama_menu }}</span>
                    <span>{{ $detail->kuantitas }} x Rp {{ number_format($detail->harga_menu, 0, ',', '.') }}</span>
                </div>
                <div class="item" style="padding-left: 10px;">
                    <span>@ Rp. {{ number_format($detail->menu->harga, 0, ',', '.') }}</span>
                </div>
                @if (!empty($detail->notes))
                    <div class="item" style="padding-left: 10px;">
                        <span>Catatan:</span>
                        <span>{{ $detail->notes }}</span>
                    </div>
                @endif
                @foreach ($detail->detailAddon as $addon)
                    <div class="item" style="padding-left: 10px;">
                        <span>+ {{ $addon->addon->nama_addon }}</span>
                        <span>{{ $addon->kuantitas }} x Rp {{ number_format($addon->harga, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            @endforeach
        </div>

        <div class="line"></div>

        <!-- Total -->
        <div class="details">
            <div class="item font-bold">
                <span>Total:</span>
                <span>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            Terima kasih telah berkunjung!
        </div>
    </div>

    <script> 
        window.onload = function() { window.print(); } 
    </script>
</body>
</html>
