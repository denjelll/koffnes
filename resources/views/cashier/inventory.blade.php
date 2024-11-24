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
            <!-- Content Area with Flex Layout -->
            <div class="ml-0 md:ml-40 w-full p-4">
                <h1 class=" text-3xl font-bold mb-4">inventory</h1>
                <!-- Content Area with Flex Layout -->
                <div class=" w-full p-4 pb-24">
                    <!-- Menambahkan padding-bottom -->
                    <div class="flex items-center justify-center h-auto p-4">
                        <!-- Card dengan ukuran lebih besar -->
                        <div class="w-[600px] h-auto bg-[#e8d2b7] rounded-lg shadow-md p-6">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr>
                                        <th class="py-3 px-4 border-b font-bold text-gray-800 text-lg">Nama Produk</th>
                                        <th class="py-3 px-4 border-b font-bold text-gray-800 text-lg">Quantity</th>
                                        <th class="py-3 px-4 border-b font-bold text-gray-800 text-lg">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="py-3 px-4 border-b text-gray-700 text-sm">Nasi Goreng</td>
                                        <td class="py-3 px-4 border-b text-gray-700 text-sm">
                                            <span class="font-bold text-gray-900">4</span>
                                            <span class="text-xs text-red-600 ml-1">⚠️ Low Stock</span>
                                        </td>
                                        <td class="py-3 px-4 border-b">
                                            <button
                                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm">
                                                Add
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 px-4 border-b text-gray-700 text-sm">Americano</td>
                                        <td class="py-3 px-4 border-b text-gray-700 text-sm">
                                            <span class="font-bold text-gray-900">10</span>
                                            <span class="text-xs text-red-600 ml-1">⚠️ Low Stock</span>
                                        </td>
                                        <td class="py-3 px-4 border-b">
                                            <button
                                                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm">
                                                Add
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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