<div class="font-sans" style="background-image: url('{{ asset('storage/asset/gambar/motif.png') }}'); background-size: 400px 400px; background-repeat: repeat; ">
    <!-- Navbar -->
    <nav
        class="bg-[#412f26] p-4 fixed top-0 w-full z-10 flex items-center justify-between text-white">
        <!-- Kembali Button -->
        <a href="/cashier" class="flex items-center space-x-2">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewbox="0 0 24 24"
                stroke="currentColor"
                class="w-6 h-6">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"></path>
            </svg>
            <span>
                <p>Keranjang</p>
            </spa>
        </a>
    </nav>

    <!-- Main Content (for spacing) -->
    <div class="pt-20 min-h-screen pb-[15rem]">
        <!-- Card Makanan -->
        @foreach ($pesanan as $item)
        <div class="rounded-lg shadow-lg bg-coconut p-4 mt-4" style="margin-right: 20px; margin-left: 20px">
            <!-- Menu Utama -->
            <div class="flex items-center mb-4">
                <img src="{{ asset('menu/' . $item['gambar']) }}" alt="Foto {{ $item['nama_menu'] }}" class="w-12 h-12 rounded-full">
                <div class="ml-4">
                    <h2 class="font-semibold text-lg text-gray-800">{{ $item['nama_menu'] }}</h2>
                    <p class="text-gray-600">Rp. <span>{{ number_format($item['harga'], 0, ',', '.') }}</span></p>
                </div>
            </div>

            <!-- Addons -->
            <div class="mb-4">
                @if (isset($addOns[$item['id_menu']]) && $addOns[$item['id_menu']]->isNotEmpty())
                    <h3 class="font-semibold text-gray-700">Tambahan</h3>
                    <p class="text-sm" style="color:#6a6f4c;">*Pilih sesuai selera</p>
                    <div class="space-y-2 mt-2">
                        @foreach ($addOns[$item['id_menu']] as $addon)
                                
                            <div class="flex items-center justify-between">
                                <p class="text-gray-600">{{ $addon->nama_addon }}</p>
                                <div class="flex items-center">
                                    <span class="text-gray-500 text-sm mr-2">Rp. {{ number_format($addon->harga, 0, ',', '.') }}</span>
                                    <button class="w-6 h-6 flex items-center justify-center rounded-full mr-2" style="background: #6a6f4c; color:white;" wire:click="kurangAddOnQty({{ $addon->id_addon }})">
                                    -
                                    </button>
                                    <span class="mx-2 bg-gray-200 text-gray-800 w-6 h-6 flex items-center justify-center rounded-full">
                                    {{ $addOnQty[$addon->id_addon] }}
                                    </span>
                                    <button class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full ml-2" style="background: #6a6f4c; color:white;" wire:click="tambahAddOnQty({{ $addon->id_addon }})">
                                    +
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Notes -->
            <div class="items-center justify-between mt-4">
                <label for="notes-{{ $item['id_menu'] }}" class="text-cocoa font-semibold">
                    Catatan:
                </label>
                <textarea
                    id="notes-{{ $item['id_menu'] }}"
                    wire:model="pesanan.{{ $loop->index }}.notes"
                    class="w-full p-2 border border-gray-300 rounded-md resize-none"
                    placeholder="Masukkan catatan untuk menu ini">
                </textarea>
            </div>

            <!-- Total Harga Makanan -->
            <div class="flex items-center justify-between mt-4">
                <p class="font-semibold text-lg text-gray-800">Total: Rp. <span id="totalPriceIndomie">{{ number_format($item['total'], 0, ',', '.') }}</span></p>
                <div class="flex items-center">
                    <button class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full mr-2" style="color:white;"  wire:click="kurangQty({{ $item['id_menu'] }})">
                        -
                    </button>
                    <span class="mx-4 text-gray-800 font-semibold">{{ $item['kuantitas'] }}</span>
                    <button class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full ml-2" style="color:white;" wire:click="tambahQty({{ $item['id_menu'] }})">
                        +
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Footer -->
    <footer class="fixed bottom-0 w-full bg-[#f3e6dd] p-3 rounded-t-lg shadow-md">
        <div
            class="flex flex-col md:flex-row md:justify-between items-start space-y-4 md:space-y-0">
            <!-- Total Price -->
            <div class="text-lg font-bold text-[#412f26] md:mr-4">
                <span class="text-2xl">Total :</span>
                <div class="text-2xl">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</div>
            </div>

            <!-- Input Fields and Options -->
            <div class="space-y-2 w-full md:w-auto">
                <div class="flex items-center space-x-2">
                    <label class="text-sm font-semibold text-[#412f26]">Name:</label>
                    <input
                        type="text"
                        id="nama_customer"
                        wire:model="customer.nama"
                        class="p-1 text-sm border rounded border-[#412f26] focus:outline-none focus:border-[#412f26] w-1/2 md:w-auto">
                </div>
                <div class="flex items-center space-x-4">
                    <label for="tipe_order" class="text-sm font-semibold text-[#412f26]">Tipe Order:</label>
                    <select
                        id="tipe_order" 
                        wire:model="customer.tipe_order" 
                        class="text-[#412f26]">

                        <option value="Dine In" class="text-sm font-semibold text-[#412f26]">Dine In</label>
                        <option value="Take Away" class="text-sm font-semibold text-[#412f26]">Take Away</label>
                        <option value="Delivery" class="text-sm font-semibold text-[#412f26]">Delivery</label>
                    </select>
                </div>
                <div class="flex items-center space-x-2" x-data 
                :class="{ 'hidden': $wire.get('customer.tipe_order') !== 'Dine In' }">
                    <label class="text-sm font-semibold text-[#412f26]">Table:</label>
                    <input
                    type="number"
                    id="table_number"
                    wire:model="customer.meja"
                    min="0"
                    class="w-12 p-1 text-sm border rounded border-[#412f26] focus:outline-none focus:border-[#412f26]">
                </div>
            </div>
        </div>

        <!-- Open Bill Button -->
        <div class="mt-4 flex flex-wrap justify-center gap-4">
            <button
                class="p-3 bg-[#412f26] text-white rounded-full font-semibold text-center hover:bg-[#5f3c21] w-40 sm:w-60 md:w-72 lg:w-80" wire:click="openBill">
                Open Bill
            </button>
        </div>

    </footer>
</div>