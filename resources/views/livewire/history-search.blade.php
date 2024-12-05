<div class="font-sans" style="background-image: url('{{ asset('storage/asset/gambar/motif.png') }}'); background-size: 400px 400px; background-repeat: repeat; ">
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
    
    <!-- Main Container -->
    <div class="flex pt-20 h-screen pb-20">

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
        <div class=" md:ml-40 p-7 w-full overflow-auto relative">
            <!-- Search Form -->
            <div class="w-[500px] mx-auto bg-[#d8c2aa] p-4 rounded-lg shadow-md">
                <h2 class="text-xl font-bold text-[#412f26] mb-3">Search History</h2>
                <form wire:submit.prevent="search" class="flex flex-col gap-4">
                    <!-- Date Range -->
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="start-date" class="block text-sm font-medium text-[#412f26]">Start Date</label>
                            <input
                                type="date"
                                id="start-date"
                                wire:model="startDate"
                                class="w-full p-2 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#412f26]">
                        </div>
                        <div class="flex-1">
                            <label for="end-date" class="block text-sm font-medium text-[#412f26]">End Date</label>
                            <input
                                type="date"
                                id="end-date"
                                wire:model="endDate"
                                class="w-full p-2 bg-white border border-gray-300 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#412f26]">
                        </div>
                    </div>
                    <!-- Customer Name -->
                    <div>
                        <label for="customer-name" class="block text-sm font-medium text-[#412f26]">Customer Name</label>
                        <input
                            type="text"
                            id="customer-name"
                            wire:model="customerName"
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
            
                <!-- Results Section -->
                <div class="mt-6">
                    <div class="flex justify-between items-center mb-3">
                        <h2 class="text-xl font-bold text-[#412f26] mb-3">Transaction Results</h2>
                        <form action="{{ route('daily.report') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-[#412f26] text-white py-1 px-3 rounded-lg text-sm hover:bg-[#5a4533]">
                                Daily Report
                            </button>
                        </form>
                    </div>
                    <ul class="space-y-4">
                        <h2 class="text-lg font-bold text-[#412f26]">Total Transaction:
                            <span>Rp. {{ number_format($totalTransaction, 0, ',', '.') }}</span>
                        </h2>
                        @forelse ($orders as $order)
                                <li class="bg-white p-4 rounded-lg shadow-md">
                                    <button class="text-[#412f26] font-semibold hover:text-[#d4ab79]" wire:click="showOrders('{{ $order->id_order }}')">ID: {{ $order->id_order }}</button>
                                    <p class="text-gray-600">Customer: {{ $order->customer }}</p>
                                    <p class="text-gray-600">Date: {{ $order->waktu_transaksi }}</p>
                                    <p class="text-gray-600">Total: Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                </li>
                        @empty
                            <li class="text-sm text-gray-500">No results found. Please refine your search.</li>
                        @endforelse
                    </ul>
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
        </div>
    </div>


    <!-- Popup Detail Orders -->
    @if ($isShowModalOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50 z-50">
            <div class="bg-[#e8d2b7] p-8 rounded-lg w-1/2 shadow-lg">
                <h3 class="text-2xl font-bold text-[#412f26] mb-6">Informasi Pesanan</h2>
                <div class="mb-6">
                    <p class="text-[#412f26]"><strong>Detail Pesanan:</strong></p>
                    <ul class="text-[#412f26] mb-4">
                        @foreach ($showDetails['menuItems'] as $menu)
                            <div class="flex justify-between">
                                <span>{{ $menu['nama_menu'] }} (x{{ $menu['kuantitas'] }})</span>
                                <span>Rp. {{ number_format($menu['total_harga'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                        @if (!empty($showDetails['addOns']))
                            <h4 class="font-semibold mt-2">Add-Ons</h4>
                            @foreach ($showDetails['addOns'] as $addon)
                                <div class="flex justify-between">
                                    <span>{{ $addon['nama_addon'] }} (x{{ $addon['kuantitas'] }})</span>
                                    <span>Rp. {{ number_format($addon['harga'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        @endif
                    </ul>
                    <p class="text-[#412f26]">
                        <strong>
                            Total Harga:
                        </strong> 
                        Rp. 
                        <span>
                            {{ number_format($showDetails['totalHarga'], 0, ',', '.') }}
                        </span>
                    </p>
                </div>
                <div class="mt-6 space-x-4"">
                    <button wire:click="$set('isShowModalOpen', false)" class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#d4ab79]">Close</button>
                    <button 
                        class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#d4ab79]"
                        onclick="printReceipt('{{ $showDetails['orderId'] }}')" >
                        Print
                    </button>
                </div>
                
            </div>
        </div>
    @endif
    
</div>

@push('scripts')
<script>
    // Ambil elemen yang dibutuhkan
    const menuToggle = document.getElementById('menu-toggle');  // Tombol hamburger
    const mobileNav = document.getElementById('mobile-nav');    // Sidebar navbar

    // Event listener untuk tombol hamburger menu
    menuToggle.addEventListener('click', () => {
        // Toggle visibility navbar dengan menambah atau menghapus kelas 'hidden'
        mobileNav.classList.toggle('hidden');
    });

    function printReceipt(orderId) {
    // Lakukan permintaan POST menggunakan Fetch API
    fetch(`{{ url('/receipt/') }}/${orderId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id_order: orderId })
    })
    .then(response => response.text()) // Dapatkan konten HTML dari respons
    .then(html => {
        // Buka jendela baru dengan ukuran tertentu dan cetak struk
        const printWindow = window.open('', '_blank', 'width=800,height=600');
        printWindow.document.write(html);
        printWindow.document.close();
        printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
    })
    .catch(error => console.error('Error:', error));
    }
</script>
@endpush