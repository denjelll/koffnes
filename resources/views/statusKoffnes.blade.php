<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    <title>Status Kafe</title>
    <style>
        html, body {
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
    <!-- Top Navbar -->
    <header
        class="w-full p-4 fixed top-0 left-0 z-10 flex items-center justify-between"
        style="background-color: #412f26;">
        <img src="{{ asset('storage/uploads/7.png') }}" alt="Logo" class="h-8 w-auto" style="max-width: 96px;">
        
        <button class="bg-[#301c1c] hover:bg-red-500 text-white font-semibold py-1 px-4 rounded-full transition hover:scale-105 duration-300 ease-in-out  shadow-lg">
            <a href="{{ route('logout') }}" class="text-white">Logout</a>
        </button>
        
        <!-- Mobile Menu Toggle Button -->
        <button id="menu-toggle" class="md:hidden text-white focus:outline-none">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6"
                fill="none"
                viewbox="0 0 24 24"
                stroke="currentColor">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16m-7 6h7"/>
            </svg>
        </button>
    </header>

    <!-- Sidebar Navigation -->
    <nav
        id="mobile-nav"
        class="text-white w-55 p-7 fixed top-16 h-full z-20 hidden bg-[#76634c] md:block"
        style="transition: transform 0.3s ease-in-out;">
        <ul class="space-y-4">
            <li>
                <a href="{{ url('cashier') }}" class="hover:bg-opacity-50 p-2 block rounded">Home</a>
            </li>
            <li>
                <a href="{{ url('cashier/dashboard') }}" class="hover:bg-opacity-50 p-2 block rounded">Order</a>
            </li>
            <li>
                <a href="{{ url('cashier/transaksi') }}" class="hover:bg-opacity-50 p-2 block rounded">History<br>Transaksi</a>
            </li>
            <li>
                <a href="{{ url('cashier/stock') }}" class="hover:bg-opacity-50 p-2 block rounded">Inventory</a>
            </li>
            <li>
                <a href="{{ route('koffnesstatus') }}" class="hover:bg-opacity-50 p-2 block rounded">Koffnes Status</a>
            </li>
        </ul>
    </nav>

    <!-- Content Area -->
    <div class="flex flex-col items-center justify-center min-h-screen p-7 w-full relative bg-transparent">
        <div class="text-3xl font-semibold mb-8 text-[#412f26]">
            Status Koffnes
        </div>
        <div class="bg-[#f1e8d4] shadow-lg rounded-lg p-8 w-full max-w-lg">
            <div class="mb-6 text-center">
                <h3 class="text-xl font-semibold text-gray-700">Status Sekarang: 
                    <span class="text-[#412f26]">{{ $status->status_koffnes }}</span>
                </h3>
            </div>
            <form action="{{ route('admin.toggleStatus') }}" method="POST" class="flex justify-center">
                @csrf
                <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-6 rounded-full transition duration-300 ease-in-out focus:outline-none focus:shadow-outline">
                    {{ $status->status_koffnes === 'open' ? 'Tutup' : 'Buka' }}
                </button>
            </form>
        </div>
    </div>

    <footer
        class="w-full p-4 fixed bottom-0 left-0 z-30 flex flex-col items-center text-white"
        style="background-color: #412f26;">
        <img
            src="{{ asset('storage/uploads/8.png') }}"
            alt="Footer Logo"
            class="h-7 md:h-7 mb-2"
            style="max-width: 180px;">
        <p class="text-sm">&copy; 2024 Koffnes. All rights reserved.</p>
    </footer>
</body>

</html>

