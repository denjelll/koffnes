<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Caschier</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="font-sans" style="background-color: #fff2e2;">

        <!-- Top Navbar -->
        <header
            class="w-full p-4 fixed top-0 left-0 z-10 flex items-center justify-between"
            style="background-color: #412f26;">
            <img src="{{ asset('storage/uploads/7.png') }}" alt="Logo" class="h-8 w-auto" style="max-width: 96px;">

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

        <!-- Main Container -->
        <div class="flex pt-20 h-screen pb-20">

            <!-- Sidebar Navigation -->
            <nav
                id="mobile-nav"
                class="text-white w-55 p-7 fixed top-16 h-full z-20 hidden bg-[#76634c] md:block"
                style="transition: transform 0.3s ease-in-out;">
                <ul class="space-y-4">
                    <li>
                        <a
                            href="{{ url('/cashier/home') }}"
                            class="hover:bg-opacity-50 p-2 block rounded">Home</a>
                    </li>
                    <li>
                        <a
                            href="{{ url('/cashier/order') }}"
                            class="hover:bg-opacity-50 p-2 block rounded">Order</a>
                    </li>
                    <li>
                        <a
                            href="{{ url('/cashier/history') }}"
                            class="hover:bg-opacity-50 p-2 block rounded">History<br>Transaksi</a>
                    </li>
                    <li>
                        <a
                            href="{{ url('/cashier/inventory') }}"
                            class="hover:bg-opacity-50 p-2 block rounded">Inventory</a>
                    </li>
                    <li>
                        <a
                            href="{{ url('cashier/table') }}"
                            class="hover:bg-opacity-50 p-2 block rounded">Table</a>
                    </li>
                </ul>
            </nav>

            <!-- Content Area -->
            <div class="ml-0 md:ml-40 w-full p-4">
                <h1 class=" text-3xl font-bold mb-4">Daftar Meja</h1>
                <x-card_table/>
                <x-card_table/>
            </div>

        </div>

        <!-- Footer -->
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

        <!-- JavaScript to Toggle Mobile Menu -->
        <script>
            const menuToggle = document.getElementById('menu-toggle');
            const mobileNav = document.getElementById('mobile-nav');

            menuToggle.addEventListener('click', () => {
                mobileNav
                    .classList
                    .toggle('hidden');
            });
        </script>

    </body>
</html>