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
                <div wire:poll.5s="refreshOrders">
                    @forelse ($orders as $order)
                        @if ($order->status === 'Open Bill')
                            <div class="flex items-center justify-between w-100 px-4 py-3 bg-[#f5e7d9] rounded-full shadow-md mt-6">
                                <div class="flex items-center space-x-2">
                                    <span class="text-2xl font-bold text-[#4b3621]">{{ $order->antrian }}#</span>
                                    <span class="font-semibold text-[#4b3621]">{{ $order->customer }}</span>
                                </div>
                                <div class="flex items-center ml-auto space-x-3">
                                    <button wire:click="approveOrder('{{ $order->id_order }}')" class="flex items-center justify-center bg-[#412f26] text-white rounded-full w-8 h-8">
                                        <h2 class="text-sm">✓</h2>
                                    </button>
                                    <button wire:click="editOrder('{{ $order->id_order }}')" class="mr-2 flex items-center justify-center bg-[#4b3621] text-white rounded-full">
                                        <h2 class="text-xl w-8 h-8">+</h2>
                                    </button>
                                    <button wire:click="cancelOrder('{{ $order->id_order }}')" class="mr-2 flex items-center justify-center bg-[#4b3621] text-white rounded-full">
                                        <h2 class="text-xl w-8 h-8">x</h2>
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
            <div class="fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50">
                <div class="bg-[#e8d2b7] p-12 rounded-lg w-1/2 shadow-lg max-h-[80vh] overflow-y-auto">
                    <h3 class="text-2xl font-bold text-[#412f26] mb-6">Konfirmasi Pembayaran</h2>
                    <div class="mb-6">
                        <p class="text-[#412f26]"><strong>Detail Pesanan:</strong></p>
                        <ul class="text-[#412f26] mb-4">
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
                        </ul>
                        <p class="text-[#412f26]">
                            <strong>
                                Total Harga:
                            </strong> 
                            Rp. 
                            <span>
                                {{ number_format($approveDetails['totalHarga'], 0, ',', '.') }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-6">
                        <label class="block mb-2 text-[#412f26]">Metode Pembayaran</label>
                            <select wire:model="paymentMethod" class="w-full p-3 border border-gray-300 rounded-md bg-[#f5e7d9]">
                                <option value="edc">EDC</option>
                                <option value="debit">Debit</option>
                                <option value="cash">Cash</option>
                            </select>
                            
                    </div>

                    @if ($paymentMethod === 'cash')
                        <div class="mb-6">
                            <label class="block mb-2 text-[#412f26]">Jumlah Uang yang Diberikan</label>
                            <input 
                                type="number" 
                                wire:model="amountPaid" 
                                class="w-full p-3 border border-gray-300 rounded-md bg-[#f5e7d9]" 
                                placeholder="Masukkan jumlah uang">
                            
                            <div class="mt-2 text-[#412f26]">
                                @if ($amountPaid >= $approveDetails['totalHarga'])
                                    <p><strong>Kembalian:</strong> Rp. {{ number_format($amountPaid - $approveDetails['totalHarga'], 0, ',', '.') }}</p>
                                @elseif ($amountPaid < $approveDetails['totalHarga'])
                                    <p class="text-red-500">Uang yang diberikan kurang!</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="flex justify-between font-bold mt-4">
                        <span>Total Harga</span>
                        <span>Rp. {{ number_format($approveDetails['totalHarga'], 0, ',', '.') }}</span>
                    </div>

                    <div class="mt-6 flex justify-end space-x-4">
                        <button wire:click="$set('isApproveModalOpen', false)" class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#d4ab79]">Batal</button>
                        <button 
                            wire:click="finalizePayment('{{ $approveDetails['orderId'] }}')" 
                            class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#d4ab79]">
                            Konfirmasi
                        </button>
                    </div>
                    
                </div>
            </div>
        @endif

        <!-- Pop Up Edit -->
        @if ($isEditModalOpen)
            <div class="fixed inset-0 flex items-center justify-center bg-gray-600 bg-opacity-50">
                <div class="bg-[#e8d2b7] p-12 rounded-lg w-1/2 shadow-lg">
                    <h3 class="text-2xl font-bold text-[#412f26] mb-6">Edit Pesanan</h2>
                        <div class="mb-6">
                            <p class="text-[#412f26]"><strong>Menu Utama:</strong></p>
                            <div class="space-y-6">
                                @foreach ($menuItems as $menu)
                                    <div class="flex items-center space-x-2 justify-between">
                                        <span>{{ $menu->menu->nama_menu }}</span>
                                        <div>
                                            <button wire:click="decreaseQuantity('{{ $menu->id_detailorder }}')" class="bg-[#412f26] text-white px-2 rounded-md">-</button>
                                            <input type="text" wire:model="quantities.{{ $menu->id_detailorder }}" class="w-12 text-center border" readonly>
                                            
                                            @if ($menu->menu->stock != 0)
                                                <button wire:click="increaseQuantity('{{ $menu->id_detailorder }}')" class="bg-[#412f26] text-white px-2 rounded-md">+</button>
                                            @else
                                                <button wire:click="increaseQuantity('{{ $menu->id_detailorder }}')" class="bg-[#f5e7d9] text-white px-2 rounded-md" disabled>+</button>
                                            @endif

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
    
                        <div class="mb-6">
                            <div id="addons-menu" class="space-y-6">
                                @foreach ($addOns as $addon)
                                    @if (!empty($addon))
                                        <p class="text-[#412f26]"><strong>Addons:</strong></p>
                                        <div class="flex items-center justify-between">
                                            <span>{{ $addon->addon->nama_addon }}</span>
                                            <div>
                                                <button wire:click="decreaseAddonQuantity('{{ $addon->id_detailaddon }}')" class="bg-[#412f26] text-white px-2 rounded-md">-</button>
                                                <input type="text" wire:model="addonQuantities.{{ $addon->id_detailaddon }}" class="w-12 text-center border" readonly>
                                                <button wire:click="increaseAddonQuantity('{{ $addon->id_detailaddon }}')" class="bg-[#412f26] text-white px-2 rounded-md">+</button>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
    
                    <div class="flex justify-end mt-6 space-x-4">
                        <button wire:click="$set('isEditModalOpen', false)" class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#d4ab79]">Batal</button>
                        <button wire:click="saveOrder" class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#d4ab79]" >Simpan</button>
                    </div>
                </div>
            </div>
        @endif
    </div>

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

    //Listener dari Livewire dispatch untuk panggil function printReceipt
    document.addEventListener('livewire:initialized', () => {
        console.log('Livewire initialized'); // Pastikan ini muncul di console.

        // Tambahkan listener untuk event 'bayarBerhasil'
        Livewire.on('bayarBerhasil', (event) => {
            if (event && event[0] && event[0].orderId) {
                const orderId = event[0].orderId;
                console.log('Order ID:', orderId); // Pastikan orderId diterima dengan benar
                printReceipt(orderId); // Panggil fungsi printReceipt dengan orderId
            } else {
                console.error('Order ID tidak ditemukan di event');
            }
        });
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

