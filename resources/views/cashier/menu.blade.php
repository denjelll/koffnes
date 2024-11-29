<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caschier</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    input::placeholder {
        color: white;
    }
</style>

<body class="font-sans" style="background-color: #fff2e2;">

    <!-- Top Navbar -->
    <header
        class="w-full p-4 fixed top-0 left-0 z-10 flex items-center justify-between"
        style="background-color: #412f26;">
        <img
            src="{{ asset('storage/uploads/7.png') }}"
            alt="Logo"
            class="h-8 w-auto"
            style="max-width: 96px;">
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

<<<<<<< HEAD
        <!-- Content Area -->
        <div class=" md:ml-40 p-7 w-full overflow-auto relative">
=======
            <!-- Content Area -->
            <div class=" md:ml-40 p-7 w-full overflow-auto relative">

                <!-- Form for Customer Info and Table Selection -->
                <form action="#" class="space-y-3">
                    <div class="flex flex-col md:flex-row items-center gap-4">
                        <input
                            type="text"
                            placeholder="Customer Name"
                            class="p-2 w-full md:w-[80rem] border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-500"
                            style="background-color: #cbb89d; color: white;">
                        <select
                            name="Dine_in"
                            id="type_order"
                            class="p-2 w-full md:w-1/3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-500"
                            style="background-color: #cbb89d; color: white;">
                            <option value="Dine_in">Dine in</option>
                            <option value="Take_away">Take away</option>
                        </select>
                    </div>
                    <div class="flex flex-col md:flex-row items-center gap-4">
                        <select
                            name="Table"
                            id="no_table"
                            class="p-2 w-full md:w-[100rem] border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-500"
                            style="background-color: #cbb89d; color: white;">
                            <option value="#" disabled="disabled" selected="selected">Choose Table</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="flex flex-col md:flex-row items-center gap-4">
                        <input
                            type="text"
                            placeholder="Search menu"
                            class="p-2 w-full md:w-[100rem] border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-500"
                            style="background-color: #cbb89d; color: white;">
                    </div>
                </form>

                <!-- Menu Cards Grid -->
                <div
                    class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2 mt-3 px-2 py-6">
                    <!-- Card Template -->
                    <x-card/>
                    <x-card/>
                    <x-card/>
                    <x-card/>
                    <x-card/>
                    <x-card/>
                    <x-card/>
                    <x-card/>

                    <!-- Total Section -->
                    <a href="{{ url('/cashier/chart') }}">
                        <div
                            class="fixed bottom-24 left-1/2 transform -translate-x-1/2 flex items-center justify-between px-5 py-2 bg-[#7d6550] text-white rounded-lg shadow-lg w-11/12 max-w-md sm:w-2/3 md:w-1/2 lg:w-1/3"
                            id="total-section">
                            <span id="total-price">Total: Rp. 0,00-</span>
                            <img src="{{ asset('storage/uploads/Cashnes.png') }}" alt="Chart Icon" class="ml-auto h-5 w-5">
                        </div>
                    </a>
>>>>>>> parent of 1fbf9f0 (Reapply "amang aja")

            <!-- Form for Customer Info and Table Selection -->
            <form action="#" class="space-y-3">
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <input
                        type="text"
                        placeholder="Customer Name"
                        class="p-2 w-full md:w-[80rem] border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-500"
                        style="background-color: #cbb89d; color: white;">
                    <select
                        name="Dine_in"
                        id="type_order"
                        class="p-2 w-full md:w-1/3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-500"
                        style="background-color: #cbb89d; color: white;">
                        <option value="Dine_in">Dine in</option>
                        <option value="Take_away">Take away</option>
                    </select>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <select
                        name="Table"
                        id="no_table"
                        class="p-2 w-full md:w-[100rem] border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-500"
                        style="background-color: #cbb89d; color: white;">
                        <option value="#" disabled="disabled" selected="selected">Choose Table</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <input
                        type="text"
                        placeholder="Search menu"
                        class="p-2 w-full md:w-[100rem] border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-500"
                        style="background-color: #cbb89d; color: white;">
                </div>
            </form>

            <!-- Menu Cards Grid -->
            <div
                class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2 mt-3 px-2 py-6">
                <!-- Card Template -->
                <x-card/>
                <x-card/>
                <x-card/>
                <x-card/>
                <x-card/>
                <x-card/>
                <x-card/>
                <x-card/>

                <!-- Total Section -->
                <a href="{{ url('/cashier/chart') }}">
                    <div
                        class="fixed bottom-24 left-1/2 transform -translate-x-1/2 flex items-center justify-between px-5 py-2 bg-[#7d6550] text-white rounded-lg shadow-lg w-11/12 max-w-md sm:w-2/3 md:w-1/2 lg:w-1/3"
                        id="total-section">
                        <span id="total-price">Total: Rp. 0,00-</span>
                        <img
                            src="{{ asset('storage/uploads/Cashnes.png') }}"
                            alt="Chart Icon"
                            class="ml-auto h-5 w-5">
                    </div>
                </a>

            </div>

        </div>

<<<<<<< HEAD
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
            // Get all menu cards and total price element
            const menuCards = document.querySelectorAll('.menu-card');
            const totalPriceElement = document.getElementById('total-price');

            // Initialize total price
            let totalPrice = 0;

            // Add event listener to each menu card
            menuCards.forEach(card => {
                card.addEventListener('click', () => {
                    const price = parseInt(card.getAttribute('data-price')); // Get price from data attribute
                    totalPrice += price; // Add to total price

                    // Update total price display
                    totalPriceElement.textContent = `Total: Rp. ${totalPrice.toLocaleString()}-`;
                });
            });
        </script>

    </body>
</html>

=======
            <!-- JavaScript to Toggle Mobile Menu -->
            <script>
                // Get all menu cards and total price element
                const menuCards = document.querySelectorAll('.menu-card');
                const totalPriceElement = document.getElementById('total-price');
>>>>>>> parent of 1fbf9f0 (Reapply "amang aja")




