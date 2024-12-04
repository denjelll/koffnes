<div class="font-sans" style="background-image: url('{{ asset('storage/asset/gambar/motif.png') }}'); background-size: 400px 400px; background-repeat: repeat; ">

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
                        href=""
                        class="hover:bg-opacity-50 p-2 block rounded">Home</a>
                </li>
                <li>
                    <a
                        href="{{ url('cashier/dashboard') }}"
                        class="hover:bg-opacity-50 p-2 block rounded">Order</a>
                </li>
                <li>
                    <a
                        href="{{ url('cashier/transaksi') }}"
                        class="hover:bg-opacity-50 p-2 block rounded">History<br>Transaksi</a>
                </li>
                <li>
                    <a
                        href="{{ url('cashier/stock') }}"
                        class="hover:bg-opacity-50 p-2 block rounded">Inventory</a>
                </li>
            </ul>
        </nav>

        <!-- Content Area -->
        <div class=" md:ml-40 p-7 w-full overflow-auto relative">

            <!-- Form for Customer Info and Table Selection -->
            <div class="space-y-4">
                <!-- Input untuk Nama Customer -->
                <div class="flex flex-col md:flex-row items-center gap-4">
                    <input
                        type="text"
                        placeholder="Customer Name"
                        class="p-2 w-full md:w-[80rem] border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        wire:model.defer="customer.nama"
                        style="background-color: #f5f5f5; color: #333;">
                    <select
                        id="orderType"
                        wire:model="customer.tipe_order"
                        class="p-2 w-full md:w-1/3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        style="background-color: #f5f5f5; color: #333;">
                        <option value="Dine In">Dine In</option>
                        <option value="Take Away">Take Away</option>
                        <option value="Delivery">Delivery</option>
                    </select>
                </div>

                <!-- Input untuk Nomor Meja -->
                <div id="tableNumberContainer" class="flex flex-col md:flex-row items-center gap-4">
                    <input
                        id="tableNumber"
                        type="number"
                        placeholder="Table Number"
                        wire:model="customer.meja"
                        class="p-2 w-full md:w-[100rem] border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        style="background-color: #f5f5f5; color: #333;">
                </div>

                <!-- Input untuk Pencarian Menu -->
                <div class="flex flex-col md:flex-row items-center gap-4">
                <!-- Input Box -->
                <div class="relative w-full md:w-[100rem]">
                    <input
                        type="text"
                        placeholder="Search menu"
                        class="p-2 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 pr-10"
                        wire:model.defer="search"
                        wire:keydown.enter="searchMenu"
                        style="background-color: #f5f5f5; color: #333;">
                <!-- Search Icon -->
                    <button
                        class="absolute inset-y-0 right-0 flex items-center text-gray-500 hover:text-blue-500 px-3"
                        wire:click="searchMenu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 104.35 4.35a7.5 7.5 0 0012.3 12.3z" />
                        </svg>
                    </button>
            </div>

            </div>


            <!-- Menu Utama -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-2 mt-3 px-2 py-6">
                @foreach ($items as $item)
                    <div wire:key="menu-{{ $item->id_menu }}" class="menu-card shadow-md rounded-lg overflow-hidden w-full relative {{ $item->stock == 0 ? 'bg-[#f0c999]' : 'bg-[#e8d2b7]' }}">
                    
                        @if ($item->stock == 0)
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                <span class="text-white font-bold text-lg">Stock Habis</span>
                            </div>
                        @endif

                        <img loading="lazy" class="w-full h-32 sm:h-48 object-cover" src="{{ $item->gambar }}" alt="Foto menu {{ $item->nama_menu }}">

                        <div class="p-2 sm:p-4 flex flex-col justify-between min-h-[150px]">
                            <h2 class="text-[#412f26] font-semibold text-sm sm:text-base">{{ $item->nama_menu }}</h2>
                            <div class="flex justify-between items-center mt-2 sm:mt-4">
                                @php
                                    $currentTime = now()->format('H:i:s');
                                    $isPromoActive = $item->promo && $item->promo->status === 'Aktif' && $currentTime >= $item->promo->waktu_mulai && $currentTime <= $item->promo->waktu_berakhir;
                                @endphp


                                @if ($isPromoActive)
                                    <div class="flex flex-col">
                                        <p class = "text-[#412f26] font-semibold text-sm sm:text-base">Promo:</p>
                                        <span class="font-bold text-[#412f26]">Rp. {{ number_format($item->promo->harga_promo, 0, ',', '.') }}</span>
                                    </div>
                                @else
                                    <span class="font-bold text-[#412f26]">Rp. {{ number_format($item->harga, 0, ',', '.') }}</span>
                                @endif

                                <!-- Tombol tambah menu -->
                                @if ($item->stock != 0)
                                    <button class="bg-[#76634c] text-white w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center" wire:click="tambahMenu('{{ $item->id_menu }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                

                <!-- Total Section -->
                <button id="confirmOrderButton">
                    <div
                        class="fixed bottom-24 left-1/2 transform -translate-x-1/2 flex items-center justify-between px-5 py-2 bg-[#7d6550] text-white rounded-lg shadow-lg w-11/12 max-w-md sm:w-2/3 md:w-1/2 lg:w-1/3">
                        <span>Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</span>
                        <img
                            src="{{ asset('storage/uploads/Cashnes.png') }}"
                            alt="Chart Icon"
                            class="ml-auto h-5 w-5">
                    </div>
                </button>
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

    </div>
</div>

<!-- Popup Alert -->

<script>
    // Ambil elemen yang dibutuhkan
    const menuToggle = document.getElementById('menu-toggle');  // Tombol hamburger
    const mobileNav = document.getElementById('mobile-nav');    // Sidebar navbar

     // Ambil elemen tombol dan input nama customer
    const confirmOrderButton = document.getElementById('confirmOrderButton');
    const customerNameInput = document.querySelector('input[wire\\:model\\.defer="customer.nama"]');

    // Tambahkan event listener untuk tombol confirm order
    confirmOrderButton.addEventListener('click', function (event) {
        // Cek apakah input nama customer kosong
        if (!customerNameInput.value.trim()) {
            event.preventDefault(); // Hentikan aksi default tombol
            alert('Nama customer belum diisi. Silakan isi nama customer sebelum melanjutkan.');
        } else {
            // Jika sudah terisi, lakukan aksi seperti biasa
            @this.call('confirmOrder'); // Panggil fungsi Livewire (opsional)
        }
    });

    // Event listener untuk tombol hamburger menu
    menuToggle.addEventListener('click', () => {
        // Toggle visibility navbar dengan menambah atau menghapus kelas 'hidden'
        mobileNav.classList.toggle('hidden');
    });

    //Buar ilangin table menu sesuai ama tipe order
    document.addEventListener('DOMContentLoaded', function () {
        const orderType = document.getElementById('orderType');
        const tableNumberContainer = document.getElementById('tableNumberContainer');

        // Listener untuk perubahan tipe order
        orderType.addEventListener('change', function () {
            if (orderType.value === 'Dine In') {
                tableNumberContainer.style.display = 'flex'; // Tampilkan input
            } else {
                tableNumberContainer.style.display = 'none'; // Sembunyikan input
            }
        });

        // Panggil event pertama kali untuk memastikan sesuai default
        orderType.dispatchEvent(new Event('change'));
    });

</script>