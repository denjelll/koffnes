<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    @livewireStyles
    <title>Order Menu</title>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Selamat Datang, {{ $customer }}</h1>
        <h2 class="text-xl font-semibold mb-4">Nomor Meja: {{ $nomorMeja }}</h2>

        <!-- Daftar Menu -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($menus as $menu)
                @livewire('menu-item', ['menu' => $menu], key($menu->id_menu))
            @endforeach
        </div>

        @livewire('total-harga')

       <!-- Tombol Checkout -->
        <form method="POST" action="">
            @csrf
            <input type="hidden" id="cartData" name="cartData">
            <button type="submit" onclick="validateCart(event)" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4">
                Checkout
            </button>
        </form>

    </div>
     @livewireScripts
</body>
</html>
