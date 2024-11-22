<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('storage/asset/gambar/icon.png') }}" type="image/png">
    @vite('resources/css/app.css') 
    <style>
        html {
            overflow-y: scroll;
            scrollbar-width: none; /* Untuk Firefox */
        }

        html::-webkit-scrollbar {
            display: none; /* Untuk Chrome, Safari, dan Edge */
        }

      body {
        background-image: url("{{ asset('storage/asset/gambar/motif.png') }}");
        background-repeat: repeat;
        background-position: top left;
        background-size: 400px 400px;
        padding-bottom: 80px;
        padding-top: 60px;
        margin: 0;
      }
    </style>
    <title>Cart</title>
  </head>
  <body class="flex flex-col min-h-screen">
    <div class="fixed top-0 left-0 w-full bg-cocoa flex items-center px-4 py-2 z-50 fixed">
        <button onclick="history.back()" style="color:white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <div class="font-semibold text-lg ml-4" style="color:white">
            Keranjang
        </div>
    </div>

    <x-customer_addons_food />

    <x-customer_addons_drink />

    <div class="fixed bottom-0 left-0 w-full bg-coconut py-4 px-4 flex justify-between items-center">
        <!-- Total Harga -->
        <div class="text-cocoa font-semibold text-lg">
            Total: Rp. <span id="totalPrice">21000</span>
        </div>

        <!-- Tombol Open Bill -->
        <button onclick="openBill()" class="bg-cocoa text-white px-6 py-2 rounded-lg font-semibold">
            Open Bill
        </button>
    </div>
</body>
</html>