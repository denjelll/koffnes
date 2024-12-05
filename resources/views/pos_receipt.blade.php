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
            size: 58mm auto;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }
        .receipt {
            width: 58mm;
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
        .fontSmall {
            font-size: 7px;
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
                <span>Tanggal:</span>
                <span>{{ $order->waktu_transaksi }}</span>
            </div>
            <div class="item">
                <span>Cashier:</span>
                <span>{{ $cashier->nama_depan }} {{ $cashier->nama_belakang }}</span>
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
                    $now = \Carbon\Carbon::parse($order->waktu_transaksi);
                    $promo = $detail->menu->promo;

                    Log::info('Transaction Time: ' . $order->waktu_transaksi);
                    Log::info('Current Promo: ', (array) $promo);
                    Log::info('Current Time Check: ' . $now);

                    // Periksa apakah promo berlaku
                    $hargaMenu = $detail->menu->harga;
                    if (
                        $promo && 
                        $promo->status === 'Aktif' &&
                        ($promo->hari === 'AllDay' || $promo->hari === $now->format('l')) &&
                        ($now->format('H:i:s') >= $promo->waktu_mulai && $now->format('H:i:s') <= $promo->waktu_berakhir)
                    ) {
                        $hargaMenu = $promo->harga_promo;
                    }

                    Log::info('Hari sekarang: ' . $now->format('l'));

                @endphp

                <div class="item">
                    <span>{{ $detail->menu->nama_menu }}</span>
                    <span>Rp {{ number_format($detail->harga_menu * $detail->kuantitas, 0, ',', '.') }}</span>
                </div>
                <div class="item" style="padding-left: 10px;">
                    <span>@ Rp. {{ number_format($hargaMenu, 0, ',', '.') }} (x{{ $detail->kuantitas }})</span>
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

    <script> 
        window.onload = function() { window.print(); } 
    </script>
</body>
</html>
