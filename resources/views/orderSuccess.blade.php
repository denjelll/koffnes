<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ $order ? 'Order Successful : ' . $id_order : 'Order Not Found' }}
    </title>
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="container mx-auto my-10">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            @if ($order)
                <h1 class="text-2xl font-bold text-center">Order Successful!</h1>
                <p class="text-center mt-4">Thank you for your order.</p>
                <p class="text-center mt-2">Your Order ID is: <strong>{{ $id_order }}</strong></p>

                <!-- Tampilkan detail order -->
                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Order Details</h2>
                    <ul class="mt-4">
                        @foreach ($order->detailOrders as $itemMenu)
                            <li class="border-b py-4">
                                <div>
                                    <strong>{{ $itemMenu->menu->nama_menu }}</strong>
                                    (x{{ $itemMenu->kuantitas }})
                                    - Rp {{ number_format($itemMenu->harga_menu, 0, ',', '.') }}
                                </div>
                                @if ($itemMenu->detailAddon->isNotEmpty())
                                    <div class="ml-4">
                                        <strong>Add-ons:</strong>
                                        <ul class="list-disc ml-6">
                                            @foreach ($itemMenu->detailAddon as $itemAddon)
                                                <li>
                                                    {{ $itemAddon->addon->nama_addon }}
                                                    (x{{ $itemAddon->kuantitas }})
                                                    - Rp {{ number_format($itemAddon->price, 0, ',', '.') }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Total Harga -->
                <div class="text-right mt-6">
                    <h3 class="text-lg font-bold">
                        Total: Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                    </h3>
                </div>
            @else
                <!-- Pesan jika order tidak ditemukan -->
                <h1 class="text-2xl font-bold text-center text-red-500">Order Not Found</h1>
                <p class="text-center mt-4">The order ID <strong>{{ $id_order }}</strong> could not be found.</p>
            @endif

            <div class="text-center mt-6">
                <a href="{{ route('order.menu', ['nomorMeja' => session('meja')]) }}" class="btn btn-primary">Back to Menu</a>
            </div>
        </div>
    </div>
</body>
</html>
