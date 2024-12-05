<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('storage/asset/gambar/icon.png') }}">
    <title>
        {{ $order ? 'Order Successful : ' . $id_order : 'Order Not Found' }}
    </title>
    @vite(['resources/css/app.css'])
    <style>
        html{
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-y: scroll;
            scrollbar-width: none; 
        }

        html::-webkit-scrollbar {
            display: none; 
        }

        body {
            background-image: url("{{ asset('storage/asset/gambar/motif.png') }}");
            background-repeat: repeat;
            background-position: top left;
            background-size: 400px 400px;
        }
    </style>
</head>
<body>
    <div class="flex items-center justify-center h-screen">
        <div class="container mx-auto my-10 px-4">
            <div class="p-6 rounded-lg shadow-lg" style="background-color: #fff2e2;">
                @if ($order)
                    <h1 class="text-2xl font-bold text-center" style="color: #568d33;">Order Successful!</h1>
                    <p class="text-center mt-4 text-gray-700">Thank you for your order.</p>
                    <p class="text-center mt-2 text-gray-700">Your Order ID is: <strong>{{ $id_order }}</strong></p>

                    <!-- Tampilkan detail order -->
                    <div class="mt-6">
                        <h2 class="text-xl font-semibold text-gray-800">Order Details</h2>
                        <ul class="mt-4">
                            @foreach ($order->detailOrders as $itemMenu)
                                <li class="border-b py-4">
                                    <div class="flex justify-between">
                                        <strong>{{ $itemMenu->menu->nama_menu }}</strong>
                                        (x{{ $itemMenu->kuantitas }})
                                        - Rp {{ number_format($itemMenu->harga_menu, 0, ',', '.') }}
                                    </div>
                                    @if ($itemMenu->detailAddon->isNotEmpty())
                                        <div class="ml-4 mt-2">
                                            <strong>Add-ons:</strong>
                                            <ul class="list-disc ml-6 text-gray-700">
                                                @foreach ($itemMenu->detailAddon as $itemAddon)
                                                    <li>
                                                        {{ $itemAddon->addon->nama_addon }}
                                                        (x{{ $itemAddon->kuantitas }})
                                                        - Rp {{ number_format($itemAddon->harga, 0, ',', '.') }}
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
                        <h3 class="text-lg font-bold text-gray-800">
                            Total: Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                        </h3>
                    </div>
                @else
                    <!-- Pesan jika order tidak ditemukan -->
                    <h1 class="text-2xl font-bold text-center text-red-500">Order Not Found</h1>
                    <p class="text-center mt-4">The order ID <strong>{{ $id_order }}</strong> could not be found.</p>
                @endif

                <div class="text-center mt-6">
                    <a href="{{ route('order.menu', ['nomorMeja' => session('meja')]) }}" class="btn btn-primary mt-2 px-6 py-2 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 bg-[#412F26] text-white hover:bg-white hover:text-[#412F26] border-none shadow-lg active:scale-95">Back to Menu</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
