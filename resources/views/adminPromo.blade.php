<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koffnes Promo Management</title>
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
            for="add-promo-modal" 
            class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] cursor-pointer whitespace-nowrap"
        >
            Add Promo
        </label>            
        
        <!-- Search Bar -->
        <input 
            type="text" 
            placeholder="Search Promo" 
            id="searchInput" 
            oninput="filterMenu()" 
            class="input w-full bg-white border-[#412f26] text-[#412f26] focus:outline-none focus:ring focus:ring-[#412f26]"
        />
    </div>
                
    <!-- Promo Section -->
    <section class="my-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-3 gap-6">

            <div class="card bg-[#f1e8d4] shadow-lg rounded-lg overflow-hidden flex flex-row items-center gap-4 p-4">
                <!-- Image Section -->
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-white rounded-full shadow-md flex items-center justify-center overflow-hidden">
                        <img src="https://via.placeholder.com/150" alt="Menu Image" class="object-cover w-full h-full" />
                    </div>
                </div>
            
                <!-- Text Section -->
                <div class="flex-grow">
                    <h2 class="font-bold text-lg text-[#412f26]">Diskon Kopsu</h2>
                    <p class="text-sm text-gray-500">Caffe Latte</p>
                    <p class="font-bold text-lg text-[#412f26] mt-1">Rp. 15.000</p>
                </div>
            
                <!-- Control Section -->
                <div class="flex flex-row items-center space-x-2">
                    <!-- Toggle -->
                    <label class="flex items-center">
                        <input type="checkbox" class="toggle toggle-sm bg-[#593c2e]" />
                    </label>
                    <!-- Button -->
                    <button class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f] px-4 py-2 rounded-md text-sm">
                        Edit Promo
                    </button>
                </div>
            </div>        
            <div class="card bg-[#f1e8d4] shadow-lg rounded-lg overflow-hidden flex flex-row items-center gap-4 p-4">
                <!-- Image Section -->
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-white rounded-full shadow-md flex items-center justify-center overflow-hidden">
                        <img src="https://via.placeholder.com/150" alt="Menu Image" class="object-cover w-full h-full" />
                    </div>
                </div>
            
                <!-- Text Section -->
                <div class="flex-grow">
                    <h2 class="font-bold text-lg text-[#412f26]">Diskon Kopsu</h2>
                    <p class="text-sm text-gray-500">Caffe Latte</p>
                    <p class="font-bold text-lg text-[#412f26] mt-1">Rp. 15.000</p>
                </div>
            
                <!-- Control Section -->
                <div class="flex flex-row items-center space-x-2">
                    <!-- Toggle -->
                    <label class="flex items-center">
                        <input type="checkbox" class="toggle toggle-sm bg-[#593c2e]" />
                    </label>
                    <!-- Button -->
                    <button class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f] px-4 py-2 rounded-md text-sm">
                        Edit Promo
                    </button>
                </div>
            </div>        
            <div class="card bg-[#f1e8d4] shadow-lg rounded-lg overflow-hidden flex flex-row items-center gap-4 p-4">
                <!-- Image Section -->
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-white rounded-full shadow-md flex items-center justify-center overflow-hidden">
                        <img src="https://via.placeholder.com/150" alt="Menu Image" class="object-cover w-full h-full" />
                    </div>
                </div>
            
                <!-- Text Section -->
                <div class="flex-grow">
                    <h2 class="font-bold text-lg text-[#412f26]">Diskon Kopsu</h2>
                    <p class="text-sm text-gray-500">Caffe Latte</p>
                    <p class="font-bold text-lg text-[#412f26] mt-1">Rp. 15.000</p>
                </div>
            
                <!-- Control Section -->
                <div class="flex flex-row items-center space-x-2">
                    <!-- Toggle -->
                    <label class="flex items-center">
                        <input type="checkbox" class="toggle toggle-sm bg-[#593c2e]" />
                    </label>
                    <!-- Button -->
                    <button class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f] px-4 py-2 rounded-md text-sm">
                        Edit Promo
                    </button>
                </div>
            </div>        

                   
        </div>  
    </section>
            
    <!-- Modal -->
    <input type="checkbox" id="add-promo-modal" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box bg-[#f1e8d4] text-[#412f26] max-w-xl">
            <!-- Modal Header -->
            <h3 class="font-bold text-lg mb-4">Add Promo</h3>
            <form>
                <!-- promo Name -->
                <div class="mb-4">
                    <label class="block mb-1" for="promo-name">Judul promo:</label>
                    <input id="promo-name" type="text" placeholder="Enter promo name" 
                        class="input input-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400" />
                </div>

                <!-- Kategori -->
                <div class="mb-4">
                    <label class="block mb-1" for="promo-category">Product:</label>
                    <select id="promo-category" 
                        class="select select-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400">
                        <option disabled selected>Pilih Product</option>
                        <option value="food">Food</option>
                        <option value="drink">Drink</option>
                        <option value="snacks">Snacks</option>
                    </select>
                </div>
    
                <!-- Diskon -->
                <div class="mb-4">
                    <label class="block mb-1" for="promo-stock">Harga diskon:</label>
                    <input id="promo-promo" type="text" placeholder="Enter promo stock" 
                        class="input input-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400" />
                </div>

                <!-- Time -->
                <div class="mb-4 flex items-center gap-4">
                    <label class="block font-bold text-[#412f26] whitespace-nowrap">Time:</label>
                    <!-- All Day Toggle -->
                    <div class="flex items-center gap-2">
                        <label class="flex items-center">
                            <input type="radio" name="time-option" class="radio radio-bordered bg-[#ffffff] border-[#412f26] checked:bg-[#412f26]" />
                            <span class="ml-1 text-[#412f26]">All Day</span>
                        </label>
                    </div>
                    <!-- Time Range -->
                    <div class="flex items-center gap-2">
                        <!-- Start Time -->
                        <div class="relative">
                            <input type="time" 
                                class="input input-bordered w-40 bg-[#f1e8d4] text-[#412f26] placeholder-gray-400 text-center border-[#412f26] focus:ring-[#412f26]" />
                        </div>
                        <span class="text-[#412f26]">-</span>
                        <!-- End Time -->
                        <div class="relative">
                            <input type="time" 
                                class="input input-bordered w-40 bg-[#f1e8d4] text-[#412f26] placeholder-gray-400 text-center border-[#412f26] focus:ring-[#412f26]" />
                        </div>
                    </div>
                </div>
    
                <!-- Modal Actions -->
                <div class="modal-action">
                    <label for="add-promo-modal" 
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
