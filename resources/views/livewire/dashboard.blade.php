<div>
    <div class="font-sans" style="background-color: #fff2e2;">
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
        <div class="flex h-screen pb-20">
    
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
                        <a href="#" class="hover:bg-opacity-50 p-2 block rounded">Table</a>
                    </li>
                </ul>
            </nav>
    
            <!-- Content Area -->
            <div class="md:ml-40 p-4 w-full overflow-auto relative pt-20">
    
                <!-- Filter and Category Buttons -->
                <div class="flex items-center gap-2 md:justify-start">
                    <button
                        class="bg-[#cbb8a0] hover:bg-[#b5a08a] text-white p-2 rounded-md flex items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewbox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-5.414 5.414a1 1 0 00-.293.707v4.172a1 1 0 01-.293.707l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 01-.293-.707v-4.172a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                    </button>
                    <button wire:click="switchTab('All')" class="hover:bg-[#b5a08a] text-white w-[60px] rounded-md {{ $currentTab === 'All' ? 'bg-[#e0bd93]' : 'bg-[#cbb8a0]'}}">All</button>
                    <button wire:click="switchTab('Dine In')" class="hover:bg-[#b5a08a] text-white w-[60px] rounded-md {{ $currentTab === 'Dine In' ? 'bg-[#e0bd93]' : 'bg-[#cbb8a0]'}}">Dine In</button>
                    <button wire:click="switchTab('Take Away')" class="hover:bg-[#b5a08a] text-white w-[90px] rounded-md {{ $currentTab === 'Take Away' ? 'bg-[#e0bd93]' : 'bg-[#cbb8a0]'}}">Take Away</button>
                </div>
    
                <!-- Card Section -->
                <div>
                    @forelse ($orders as $order)
                        @if ($order->status === 'Open Bill')
                            <div class="flex items-center justify-between w-100 px-4 py-3 bg-[#f5e7d9] rounded-full shadow-md mt-6">
                                <div class="flex items-center space-x-2">
                                    <span class="text-2xl font-bold text-[#4b3621]">{{ $order->antrian }}#</span>
                                    <span class="font-semibold text-[#4b3621]">{{ $order->customer }}</span>
                                </div>
                                <div class="flex">
                                    <button wire:click="approveOrder('{{ $order->id_order }}')" class="mr-2 flex items-center justify-center bg-[#4b3621] text-white rounded-full">
                                        <h2 class="text-xl w-8 h-8 font-bold">✓</h2>
                                    </button>
                                    <button wire:click="editOrder('{{ $order->id_order }}')" class="mr-2 flex items-center justify-center bg-[#4b3621] text-white rounded-full">
                                        <h2 class="text-xl w-8 h-8 font-bold">+</h2>
                                    </button>
                                    <button wire:click="cancelOrder('{{ $order->id_order }}')" class="flex items-center justify-center bg-[#4b3621] text-white rounded-full">
                                        <h2 class="text-xl w-8 h-8 font-bold">X</h2>
                                    </button>
                                </div>    
                            </div>
                        @endif
                    @empty
                        <p class="flex justify-center items-center">Tidak Ada Orderan</p>
                    @endforelse
                </div>
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
    

    <!-- Pop Up -->
    <!-- Pop Up Approve -->
    <div>
        @if ($isApproveModalOpen)
            <div class="fixed inset-0 bg-gray-800 bg-opacity-75 z-50 flex items-center justify-center">
                <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full p-6">
                    <h2 class="text-lg font-bold mb-4">Konfirmasi Pembayaran</h2>
                    <h3 class="font-semibold">Detail Pesanan</h3>
                    <div class="mb-4">
                        @foreach ($approveDetails['menuItems'] as $menu)
                            <div class="flex justify-between">
                                <span>{{ $menu['nama_menu'] }}</span>
                                <span>{{ $menu['kuantitas'] }} x Rp. {{ number_format($menu['harga'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                        @if (!empty($approveDetails['addOns']))
                            <h4 class="font-semibold mt-2">Add-Ons</h4>
                            @foreach ($approveDetails['addOns'] as $addon)
                                <div class="flex justify-between">
                                    <span>{{ $addon['nama_addon'] }}</span>
                                    <span>{{ $addon['kuantitas'] }} x Rp. {{ number_format($addon['harga'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div wire:model="paymentMethod" class="border border-black">
                        <select class="w-full">
                            <option value="edc">EDC</option>
                            <option value="debit">Debit</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>

                    <div class="flex justify-between font-bold mt-4">
                        <span>Total Harga</span>
                        <span>Rp. {{ number_format($approveDetails['totalHarga'], 0, ',', '.') }}</span>
                    </div>

                    <div class="mt-4 flex justify-end space-x-4">
                        <button wire:click="$set('isApproveModalOpen', false)" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                        <button wire:click="finalizePayment('{{ $approveDetails['orderId'] }}')" class="bg-green-500 text-white px-4 py-2 rounded">Konfirmasi</button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Pop Up Edit -->
        @if ($isEditModalOpen)
            <div class="fixed inset-0 bg-gray-800 bg-opacity-75 z-50 flex items-center justify-center">
                <div class="bg-white rounded-lg shadow-lg max-w-2xl w-full mx-auto p-4">
                    <h2 class="text-lg font-bold mb-4">Edit Pesanan</h2>
                    <h3 class="font-semibold">Menu Utama</h3>
                    <div>
                        @foreach ($menuItems as $menu)
                            <div class="flex items-center justify-between">
                                <span>{{ $menu->menu->nama_menu }}</span>
                                <div>
                                    <button wire:click="decreaseQuantity('{{ $menu->id_detailorder }}')" class="bg-gray-300 px-2">-</button>
                                    <input type="text" wire:model="quantities.{{ $menu->id_detailorder }}" class="w-12 text-center border">
                                    <button wire:click="increaseQuantity('{{ $menu->id_detailorder }}')" class="bg-gray-300 px-2">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    <h3 class="font-semibold mt-4">Add-Ons</h3>
                    <div>
                        @foreach ($addOns as $addon)
                            <div class="flex items-center justify-between">
                                <span>{{ $addon->addon->nama_addon }}</span>
                                <div>
                                    <button wire:click="decreaseAddonQuantity('{{ $addon->id_detailaddon }}')" class="bg-gray-300 px-2">-</button>
                                    <input type="text" wire:model="addonQuantities.{{ $addon->id_detailaddon }}" class="w-12 text-center border">
                                    <button wire:click="increaseAddonQuantity('{{ $addon->id_detailaddon }}')" class="bg-gray-300 px-2">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    <div class="mt-4">
                        <button wire:click="saveOrder" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                        <button wire:click="$set('isEditModalOpen', false)" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
</div>
