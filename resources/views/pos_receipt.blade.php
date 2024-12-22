<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('storage/asset/gambar/icon.png') }}">
    <title>Struk Pembayaran</title>
    <style>
        /* Ukuran kertas 58mm x auto */
        @page {
            size: 58mm 50mm;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }
        .receipt {
            width: 58mm auto;
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
        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
        .footer {
            margin-top: 10px;
            text-align: center;
        }
        .fontSmall {
            font-size: 10px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <!-- Header -->
        <div class="header">
            <div>KOFFNES</div>
            <div class="fontSmall">Jl. Rawa Buntu Utara No.7 BLOK A, RT.4/RW.4, Rw. Buntu, BSD, Kec. Serpong, Kota Tangerang Selatan, Banten 15310</div>
        </div>
        <div class="line"></div>

        <!-- Info Transaksi -->
        <div class="details">
            <div class="item">
                <span>ID Order:</span>
                <strong>{{ $order->id_order }}</strong>
            </div>
            <div class="item">
                <span>Tanggal:</span>
                <span>{{ $order->waktu_transaksi }}</span>
            </div>
            <div class="item">
                <span>Cashier:</span>
                <span>{{ $order->cashier->nama_depan }} {{ $order->cashier->nama_belakang }}</span>
            </div>
            <div class="item">
                <span>Status:</span>
                <span>{{ $order->status }}</span>
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
                @php
                    // Hitung harga satuan
                    $hargaSatuan = $detail->harga_menu / $detail->kuantitas;
                @endphp

                <div class="item">
                    <strong>- {{ $detail->menu->nama_menu }}</strong>
                    <span>Rp {{ number_format($hargaSatuan * $detail->kuantitas, 0, ',', '.') }}</span>
                </div>
                <div class="item" style="padding-left: 10px;">
                    <span>@ Rp. {{ number_format($hargaSatuan, 0, ',', '.') }} (x{{ $detail->kuantitas }})</span>
                </div>
                @if (!empty($detail->notes))
                    <div class="item" style="padding-left: 10px;">
                        <span>Notes:</span>
                        <span>{{ $detail->notes }}</span>
                    </div>
                @endif
                @foreach ($detail->detailAddon as $addon)
                    <div class="item" style="padding-left: 10px;">
                        <span>+ {{ $addon->addon->nama_addon }}</span>
                        <span>(x{{ $addon->kuantitas }}) x Rp {{ number_format($addon->harga, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            @endforeach
        </div>

        <div class="line"></div>

        <!-- Total -->
        <div class="details">
            <div class="item font-bold">
                <span>Total:</span>
                <strong>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
            </div>

            <div class="item">
                <span>Bayar:</span>
                <span>Rp {{ number_format($order->bayar, 0, ',', '.') }}</span>
            </div>

            <div class="item">
                <span>Kembalian:</span>
                <span>Rp {{ number_format($order->kembalian, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="line"></div>
        <!-- Footer -->
        <div class="footer">
            Terima kasih telah berkunjung!
        </div>
    </div>
</body>
</html>
