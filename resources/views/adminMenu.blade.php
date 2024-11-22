<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koffnes Menu Management</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Force background color to white for body and .bg-base-100 */
        body, .bg-base-100 {
            background-color: white !important;
        }
        body {
            background-image: url("D:/File UMN/bg kopi.jpg"); /* Replace with the path to the background image */
            background-repeat: repeat;
            background-position: top left;
            background-size: 400px 400px;
        }
    </style>
</head>
<body class="font-sans bg-base-200">

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

    <!-- Main Content -->
    <div class="px-8 py-6 pb-[4rem]">
        <div class="text-2xl font-semibold text-[#412f26] mb-6">Menu Management</div>

    <!-- Search and Filter Section -->
    <div class="flex items-center gap-4 mb-8">
        <!-- Add Event Button -->
        <label 
            for="add-menu-modal" 
            class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] cursor-pointer whitespace-nowrap"
        >
            Add Menu
        </label>            
        
        <!-- Search Bar -->
        <input 
            type="text" 
            placeholder="Search Menu" 
            id="searchInput" 
            oninput="filterMenu()" 
            class="input w-full bg-white border-[#412f26] text-[#412f26] focus:outline-none focus:ring focus:ring-[#412f26]"
        />
        <!-- Category Filter -->
        <select 
            id="categoryFilter" 
            onchange="filterMenu()" 
            class="select bg-white border-[#412f26] text-[#412f26] focus:outline-none focus:ring focus:ring-[#412f26]"
        >
            <option value="All">All Categories</option>
            <option value="Food">Food</option>
            <option value="Drink">Drink</option>
            <option value="Snack">Snack</option>
        </select>
    </div>
                

        <!-- Food Section -->
        <section class="my-6">
            <h2 class="text-2xl font-bold text-[#412f26] mb-4">Food</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                <div class="card w-60 bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- Image Placeholder -->
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <img
                            src="https://via.placeholder.com/150"
                            alt="Menu Image"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <!-- Text Content -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-[#412f26]">Nasi Lemak</h3>
                        <p class="text-gray-500 font-medium">Rp. 15.000</p>
                    </div>
                    <!-- Button -->
                    <div class="p-4 pt-0">
                        <button class="btn bg-[#412f26] text-white w-full rounded-md hover:bg-[#593c2e]">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Drinks Section -->
        <section class="my-6">
            <h2 class="text-2xl font-bold text-[#412f26] mb-4">Drinks</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                <!-- Drinks Menu Item Card -->
                <div class="card w-60 bg-white shadow-md rounded-lg overflow-hidden">
                    <!-- Image Placeholder -->
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <img
                            src="https://via.placeholder.com/150"
                            alt="Menu Image"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <!-- Text Content -->
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-[#412f26]">Es Tehhhh</h3>
                        <p class="text-gray-500 font-medium">Rp. 5.000</p>
                    </div>
                    <!-- Button -->
                    <div class="p-4 pt-0">
                        <button class="btn bg-[#412f26] text-white w-full rounded-md hover:bg-[#593c2e]">
                            Edit
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal -->
    <input type="checkbox" id="add-menu-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-[#f1e8d4] text-[#412f26] max-w-xl">
            <!-- Modal Header -->
            <h3 class="font-bold text-lg mb-4">Add Menu</h3>
            <form>
                <!-- Menu Name -->
                <div class="mb-4">
                    <label class="block mb-1" for="menu-name">Nama Menu:</label>
                    <input id="menu-name" type="text" placeholder="Enter menu name" 
                        class="input input-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400" />
                </div>

                <!-- Harga -->
                <div class="mb-4">
                    <label class="block mb-1" for="menu-price">Harga:</label>
                    <input id="menu-price" type="text" placeholder="Enter menu price" 
                        class="input input-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400" />
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label class="block mb-1" for="menu-category">Kategori:</label>
                    <select id="menu-category" 
                        class="select select-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400">
                        <option disabled selected>Pilih Kategori</option>
                        <option value="food">Food</option>
                        <option value="drink">Drink</option>
                        <option value="snacks">Snacks</option>
                    </select>
                </div>

    
                <!-- Description -->
                <div class="mb-4">
                    <label class="block mb-1" for="menu-description">Deskripsi:</label>
                    <textarea id="menu-description" placeholder="Enter menu description"
                        class="textarea textarea-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400"></textarea>
                </div>
    
                <!-- Stock -->
                <div class="mb-4">
                    <label class="block mb-1" for="menu-stock">Stock:</label>
                    <input id="menu-menu" type="text" placeholder="Enter menu stock" 
                        class="input input-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400" />
                </div>

                <!-- Image Upload -->
                <div class="mb-4">
                    <label class="block mb-1" for="menu-image">Gambar:</label>
                    <!-- Custom File Input -->
                    <div class="relative">
                        <label for="menu-image" 
                               class="cursor-pointer bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] inline-block">
                            Choose File
                        </label>
                        <input id="menu-image" type="file" accept="image/*" 
                               class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                        <span id="file-name" class="ml-3 text-[#412f26]">No file chosen</span>
                    </div>
                </div>
    
                <!-- Modal Actions -->
                <div class="modal-action">
                    <label for="add-menu-modal" 
                           class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f]">
                        Cancel
                    </label>
                    <button type="submit" 
                            class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f]">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <footer
    class="w-full p-4 fixed bottom-0 left-0 z-30 flex flex-col items-center text-white"
    style="background-color: #412f26; height: 64px;">
    <img
        src="../img/8.png"
        alt="Footer Logo"
        class="h-7 md:h-7 mb-2"
        style="max-width: 180px;">
    <p class="text-sm">&copy; 2024 Koffnes. All rights reserved.</p>
    </footer>

</body>
</html>
