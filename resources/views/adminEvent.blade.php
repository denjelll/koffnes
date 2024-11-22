<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koffnes Event Management</title>
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
<body class="font-sans bg-white">

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
        <div class="flex items-center justify-between mb-6">
            <div class="text-2xl font-semibold text-[#412f26]">Event Management</div>
            <!-- Add Event Button -->
            <label for="add-event-modal" class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] cursor-pointer">
                Add Event
            </label>
        </div>
    
        <!-- Divider Line -->
        <hr class="border-t border-[#b18968] mb-8">

        <!-- Event Section -->
        <section class="my-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-2 gap-6">
                <div class="card bg-white shadow-lg relative overflow-hidden">
                    <!-- Image as background -->
                    <figure class="relative w-full h-72">
                        <img src="tekken.jpg" 
                            alt="Lomba Tekken 8 Koffnes" 
                            class="absolute inset-0 w-full h-full object-cover" />
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white/90 via-white/60 to-transparent p-6 flex flex-col justify-end">
                            <!-- Text Content and Button Row -->
                            <div class="flex items-center justify-between w-full">
                                <!-- Text Content -->
                                <div class="text-left">
                                    <h2 class="text-[#412f26] font-bold text-xl">Lomba Tekken 8 Koffnes</h2>
                                    <p class="text-[#412f26] text-sm mt-1">
                                        Lomba yang akan di adakan tanggal 10 Januari 2025, menangkan hadiah sebesar Rp.10.000.000
                                    </p>
                                </div>
                                <!-- Button -->
                                <button class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f] px-6 py-2 rounded-md">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </figure>
                </div>
                <div class="card bg-white shadow-lg relative overflow-hidden">
                    <!-- Image as background -->
                    <figure class="relative w-full h-72">
                        <img src="tekken.jpg" 
                            alt="Lomba Tekken 8 Koffnes" 
                            class="absolute inset-0 w-full h-full object-cover" />
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white/90 via-white/60 to-transparent p-6 flex flex-col justify-end">
                            <!-- Text Content and Button Row -->
                            <div class="flex items-center justify-between w-full">
                                <!-- Text Content -->
                                <div class="text-left">
                                    <h2 class="text-[#412f26] font-bold text-xl">Lomba Tekken 8 Koffnes</h2>
                                    <p class="text-[#412f26] text-sm mt-1">
                                        Lomba yang akan di adakan tanggal 10 Januari 2025, menangkan hadiah sebesar Rp.10.000.000
                                    </p>
                                </div>
                                <!-- Button -->
                                <button class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f] px-6 py-2 rounded-md">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </figure>
                    
                </div>
                <div class="card bg-white shadow-lg relative overflow-hidden">
                    <!-- Image as background -->
                    <figure class="relative w-full h-72">
                        <img src="tekken.jpg" 
                            alt="Lomba Tekken 8 Koffnes" 
                            class="absolute inset-0 w-full h-full object-cover" />
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white/90 via-white/60 to-transparent p-6 flex flex-col justify-end">
                            <!-- Text Content and Button Row -->
                            <div class="flex items-center justify-between w-full">
                                <!-- Text Content -->
                                <div class="text-left">
                                    <h2 class="text-[#412f26] font-bold text-xl">Lomba Tekken 8 Koffnes</h2>
                                    <p class="text-[#412f26] text-sm mt-1">
                                        Lomba yang akan di adakan tanggal 10 Januari 2025, menangkan hadiah sebesar Rp.10.000.000
                                    </p>
                                </div>
                                <!-- Button -->
                                <button class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f] px-6 py-2 rounded-md">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </figure>
                </div>
            </div>
        </section>



    </div>

<!-- Modal -->
<input type="checkbox" id="add-event-modal" class="modal-toggle" />
<div class="modal">
    <div class="modal-box bg-[#f1e8d4] text-[#412f26] max-w-xl">
        <!-- Modal Header -->
        <h3 class="font-bold text-lg mb-4">Add Event</h3>
        <form>
            <!-- Event Name -->
            <div class="mb-4">
                <label class="block mb-1" for="event-name">Nama Event:</label>
                <input id="event-name" type="text" placeholder="Enter event name" 
                    class="input input-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400" />
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block mb-1" for="event-description">Deskripsi:</label>
                <textarea id="event-description" placeholder="Enter event description"
                    class="textarea textarea-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400"></textarea>
            </div>

            <!-- Contact -->
            <div class="mb-4">
                <label class="block mb-1" for="event-contact">Contact:</label>
                <input id="event-contact" type="text" placeholder="Enter contact information" 
                    class="input input-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400" />
            </div>

            <!-- Date & Time -->
            <div class="mb-4">
                <label class="block mb-1" for="event-datetime">Date & Time:</label>
                <input id="event-datetime" type="datetime-local" 
                    class="input input-bordered w-full bg-[#ffffff] text-[#412f26] placeholder-gray-400" />
            </div>

            <!-- Banner Upload -->
            <div class="mb-4">
                <label class="block mb-1" for="event-banner">Banner:</label>
                <!-- Custom File Input -->
                <div class="relative">
                    <label for="event-banner" 
                           class="cursor-pointer bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] inline-block">
                        Choose File
                    </label>
                    <input id="event-banner" type="file" accept="image/*" 
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                    <span id="file-name" class="ml-3 text-[#412f26]">No file chosen</span>
                </div>
            </div>

            <!-- Modal Actions -->
            <div class="modal-action">
                <label for="add-event-modal" 
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
