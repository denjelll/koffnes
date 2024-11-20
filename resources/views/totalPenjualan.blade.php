<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Recap</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {},
            },
            plugins: [daisyui],
            daisyui: {
                themes: ["light"],
            },
        };
    </script>
    <style>
        body {
            background-image: url("{{ asset('asset/Cashnes/motif.png') }}");
            background-repeat: repeat;
            background-position: top left;
            background-size: 400px 400px;
            padding-bottom: 80px;
            margin: 0;
        }
        nav {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>
<body class="min-h-screen bg-[#EDE1D2] relative">

    <!-- Navbar -->
    <nav class="bg-[#412F26] text-white py-3 px-6 flex flex-col md:flex-row justify-between items-center shadow-lg">
        <!-- Logo -->
        <div class="flex items-center justify-between w-full md:w-auto">
            <img src="{{ asset('asset/Cashnes/8.png') }}" alt="Koffnes Logo" class="h-8 md:h-10">
            <button id="burger-menu" class="md:hidden text-white focus:outline-none" aria-label="Toggle Navigation">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <!-- Menu -->
        <div id="nav-links" class="hidden md:flex md:flex-row md:space-x-6 flex-col text-center mt-4 md:mt-0 w-full md:w-auto">
            <a href="#" class="hover:underline">Menu Management</a>
            <a href="#" class="hover:underline">Transaction</a>
            <a href="#" class="hover:underline">Event Management</a>
            <a href="#" class="hover:underline">Promotion</a>
            <a href="#" class="hover:underline">Admin</a>
            <a href="#" class="hover:underline text-[#CBB89D]">Logout</a>
        </div>
    </nav>

    <!-- Header -->
    <div class="text-center mt-20 mb-6 pt-20">
        <h1 class="text-4xl sm:text-3xl lg:text-5xl font-bold text-[#412F26]">Transaction Recap</h1>
    </div>

    <!-- Content -->
    <div class="flex flex-col md:flex-row justify-center items-center gap-4 mb-6 px-4">
        <!-- Search and Date Range -->
        <form class="w-full md:w-1/1 lg:w-1/3">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-[#CBB89D] focus:border-[#CBB89D]" placeholder="Search Transactions..." required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-[#412F26] hover:bg-[#CBB89D] focus:ring-4 focus:outline-none focus:ring-[#CBB89D] font-medium rounded-lg text-sm px-4 py-2">Search</button>
            </div>
        </form>
        <div class="flex gap-2 items-center">
            <input type="date" class="p-2 text-center bg-[#CBB89D] text-black rounded-lg focus:outline-none focus:ring-2 focus:ring-[#412F26]" />
            <span class="text-black font-bold">-</span>
            <input type="date" class="p-2 text-center bg-[#CBB89D] text-black rounded-lg focus:outline-none focus:ring-2 focus:ring-[#412F26]" />
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto mx-auto max-w-6xl shadow-md border border-gray-300 rounded-lg">
        <table class="table-auto w-full text-center">
            <thead class="bg-[#412F26] text-white">
                <tr>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Total Penjualan</th>
                </tr>
            </thead>
            <tbody id="table-body" class="bg-white text-black">
                <!-- Table rows will be populated dynamically from backend -->
            </tbody>
        </table>
    </div>

    <script>
        // Example data
        const transactionData = [
            { tanggal: '08/11/2024', totalPenjualan: 'Rp 200.000' },
            { tanggal: '09/11/2024', totalPenjualan: 'Rp 150.000' },
            { tanggal: '10/11/2024', totalPenjualan: 'Rp 300.000' },
        ];

        // table dynamically
        const tableBody = document.getElementById('table-body');
        transactionData.forEach((transaction) => {
            const row = document.createElement('tr');
            row.classList.add('border-b', 'border-gray-300');

            row.innerHTML = `
                <td class="p-4">${transaction.tanggal}</td>
                <td class="p-4">${transaction.totalPenjualan}</td>
            `;
            tableBody.appendChild(row);
        });
    </script>
     <!-- Download Button -->
     <div class="flex justify-center mt-6">
        <button class="bg-[#412F26] text-white px-6 py-3 rounded-lg hover:bg-[#CBB89D] focus:outline-none">
            Download Excel
        </button>
    </div>
</body>
</html>
