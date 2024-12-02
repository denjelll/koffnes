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
                        <a href="{{ url('/cashier/home') }}" class="hover:bg-opacity-50 p-2 block rounded">Home</a>
                    </li>
                    <li>
                        <a href="{{ url('/cashier/order') }}" class="hover:bg-opacity-50 p-2 block rounded">Order</a>
                    </li>
                    <li>
                        <a href="{{ url('/cashier/history') }}" class="hover:bg-opacity-50 p-2 block rounded">History<br>Transaksi</a>
                    </li>
                    <li>
                        <a href="{{ url('/cashier/inventory') }}" class="hover:bg-opacity-50 p-2 block rounded">Inventory</a>
                    </li>
                    <li>
                        <a href="{{ url('cashier/table') }}" class="hover:bg-opacity-50 p-2 block rounded">Table</a>
                    </li>
                </ul>
            </nav>

            <!-- Content Area -->
            <div class=" md:ml-40 p-7 w-full overflow-auto relative">
    <!-- Search Form -->
    <div class="w-[500px] mx-auto bg-[#d8c2aa] p-4 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-bold text-[#412f26] mb-3">Search History</h2>
        <form id="searchForm" class="flex flex-col gap-4">
            <!-- Date Range -->
            <div class="flex gap-4">
                <div class="flex-1">
                    <label for="start-date" class="block text-sm font-medium text-[#412f26]">Start Date</label>
                    <input
                        type="date"
                        id="start-date"
                        name="start_date"
                        class="w-full p-2 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#412f26]"
                        required="required">
                </div>
                <div class="flex-1">
                    <label for="end-date" class="block text-sm font-medium text-[#412f26]">End Date</label>
                    <input
                        type="date"
                        id="end-date"
                        name="end_date"
                        class="w-full p-2 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#412f26]"
                        required="required">
                </div>
            </div>
            <!-- Transaction Name (now for Customer Name) -->
            <div>
                <label for="search-name" class="block text-sm font-medium text-[#412f26]">Customer Name</label>
                <input
                    type="text"
                    id="search-name"
                    name="customer_name"
                    placeholder="Enter customer name"
                    class="w-full p-2 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#412f26]">
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full py-2 bg-[#412f26] text-white rounded-lg hover:bg-[#5a4533]">
                Search
            </button>
        </form>
    </div>

    <div class="w-[500px] mx-auto bg-[#d8c2aa] p-4 rounded-lg shadow-md">
    <div class="flex justify-between items-center mb-3">
        <h2 class="text-xl font-bold text-[#412f26]">Transaction Results</h2>
        <a
            href="/cashier/history/download"
            class="bg-[#412f26] text-white py-1 px-3 rounded-lg text-sm hover:bg-[#5a4533]">
            Download
        </a>
    </div>
    <div id="totalTransaction" class="text-lg font-bold text-[#412f26] mb-4 hidden">
        Total Transaction: <span id="totalAmount">Rp0</span>
    </div>
    <ul id="results" class="space-y-4">
        <!-- Search results will be injected here -->
        <li class="text-sm text-gray-500">No results found. Please use the search bar above.</li>
    </ul>
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
    const resultsContainer = document.getElementById("results");
    const totalTransaction = document.getElementById("totalTransaction");
    const totalAmount = document.getElementById("totalAmount");

    const mockResults = [
        { customer: "Brian", date: "2024-11-28 19:27:51", total: 42214 },
        { customer: "Kirby", date: "2024-11-28 20:27:51", total: 50214 },
    ];

    function displayResults(data) {
        // Clear current results
        resultsContainer.innerHTML = "";

        let totalSum = 0;

        if (data.length === 0) {
            resultsContainer.innerHTML = `<li class="text-sm text-gray-500">No results found. Please use the search bar above.</li>`;
            totalTransaction.classList.add("hidden");
            return;
        }

        // Calculate total and show it first
        data.forEach((item) => {
            totalSum += item.total;
        });

        totalAmount.textContent = `Rp${totalSum.toLocaleString()}`;
        totalTransaction.classList.remove("hidden");

        // Render cards for each transaction
        data.forEach((item) => {
            const card = document.createElement("li");
            card.classList.add("bg-white", "p-4", "rounded-lg", "shadow", "text-gray-800");
            card.innerHTML = `
                <p><strong>Customer:</strong> ${item.customer}</p>
                <p><strong>Date:</strong> ${item.date}</p>
                <p><strong>Total:</strong> Rp${item.total.toLocaleString()}</p>
            `;
            resultsContainer.appendChild(card);
        });
    }

    // Mock data loading on page load
    document.addEventListener("DOMContentLoaded", () => {
        displayResults(mockResults);
    });
</script>


            </body>
        </html>
