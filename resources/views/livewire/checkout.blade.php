<div>
    @push('styles')
    <style>
        html {
            overflow-y: scroll;
            scrollbar-width: none; 
        }

        html::-webkit-scrollbar {
            display: none; 
        }

        body {
            background-image: url("{{ asset('storage/asset/gambar/motif.png') }}");
            background-repeat: repeat;
            background-position: top left;
            background-size: 400px 400px;
            padding-bottom: 80px;
            padding-top: 60px;
            margin: 0;
        }
    </style>
    @endpush

    <div class="flex flex-col min-h-screen">
        <div class="fixed top-0 left-0 w-full bg-cocoa flex items-center px-4 py-2 z-50 fixed">
            <button onclick="history.back()" style="color:white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <div class="font-semibold text-lg ml-4" style="color:white">
                Keranjang
            </div>
        </div>

        
    
        <!-- Daftar Item di Cart -->
        @foreach($cartItems as $key => $item)
            <div id="addonsCard" class="rounded-lg shadow-lg bg-coconut p-4 mt-4" style="margin-right: 20px; margin-left: 20px">
                <!-- Header: Menu Title and Price -->
                <div class="flex items-center mb-4">
                    <img src="{{ asset('menu/'.$item['menu']->gambar) }}" alt="{{ $item['menu']->nama_menu }}" class="w-12 h-12 rounded-full">
                    <div class="ml-4">
                        <h2 class="font-semibold text-lg text-gray-800">{{ $item['menu']->nama_menu }}</h2>
                        <p class=" text-gray-600">Rp {{ number_format($item['menu']->harga, 0, ',', '.' ) }}</p>
                    </div>
                </div>
    
               <!-- Addons Section -->
               @if(!empty($item['addOn']))
               <div class="mb-4">
                    <h3 class="font-semibold text-gray-700">Add On</h3>
                    <p class="text-sm" style="color:#6a6f4c;">*Pilih sesuai selera</p>
                   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                       @foreach ($item['addOn'] as $addon)
                            <div class="flex items-center justify-between">
                                <p class="text-gray-600">{{ $addon['nama_addon'] }}</p>
                                <div class="flex items-center">
                                    <span class="text-gray-500 text-sm mr-2">Rp. {{ number_format($addon['harga'], 0, ',', '.') }}</span>
                                    <!-- Tombol Kurangi -->
                                        <button 
                                        class="w-6 h-6 flex items-center justify-center rounded-full mr-2" style="background: #6a6f4c; color:white;"
                                        wire:click="updateAddonQuantity({{ $item['menu']['id_menu'] }}, {{ $addon['id_addon'] }}, 'decrement')">
                                        <h2 class="text-xl w-8 h-8 font-bold"><a>-</a></h2>
                                    </button>
                                    
                                    <!-- Kuantitas -->
                                    <span class="mx-2 bg-gray-200 text-gray-800 w-6 h-6 flex items-center justify-center rounded-full">{{ $addon['quantity'] ?? 0 }}</span>
                                    
                                    <!-- Tombol Tambah -->
                                    <button 
                                        class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full ml-2" style="background: #6a6f4c; color:white;"
                                        wire:click="updateAddonQuantity({{ $item['menu']['id_menu'] }}, {{ $addon['id_addon'] }}, 'increment')">
                                        <h2 class="text-xl w-8 h-8 font-bold"><a>+</a></h2>
                                    </button>
                                </div>
                           </div>
                       @endforeach
                   </div>
               </div>
               @endif

               
                <!-- Notes -->
                <div class="items-center justify-between mt-4">
                    <label for="notes-{{ $key }}" class="text-cocoa font-semibold">
                        Catatan:
                    </label>
                    <textarea
                        id="notes-{{ $key }}"
                        wire:model="cartItems.{{ $key }}.notes"
                        class="w-full p-2 border border-gray-300 rounded-md resize-none"
                        placeholder="Masukkan catatan untuk menu ini">
                    </textarea>
                </div>
    
                <!-- Kuantitas -->
                <div class="flex items-center justify-between mt-4">
                    <!-- Harga Item -->
                    <p class="font-semibold text-lg text-gray-800">
                        Rp. {{ number_format(($item['quantity'] ?? 0) * 
                        ($item['menu']->promo && $item['menu']->promo->status === 'Aktif' && (now()->format('l') === $item['menu']->promo->hari || $item['menu']->promo->hari === 'AllDay') && now()->between($item['menu']->promo->waktu_mulai, $item['menu']->promo->waktu_berakhir) ? $item['menu']->promo->harga_promo : $item['menu']->harga) + 
                        collect($item['addOn'] ?? [])->sum(function ($addon) 
                        { return $addon['harga'] * ($addon['quantity'] ?? 0); }), 0, ',', '.' ) }}
                    </p>
                    <div class="flex justify-center items-center">
                        <button 
                            wire:click="updateMenuQuantity({{ $item['menu']->id_menu }}, {{ $item['quantity'] - 1 }})"
                            class="text-white bg-cocoa w-8 h-8 flex items-center justify-center rounded-full mr-2"
                            :disabled="{{ $item['quantity'] <= 0 ? 'true' : 'false' }}">
                            <h2 class="text-xl w-8 h-8 font-bold"><a>-</a></h2>
                        </button>
                        
                        <span class="font-bold text-[#412F26] mx-2 text-sm sm:text-base"  wire:change="updateMenuQuantity({{ $item['menu']->id_menu }}, $event.target.value)">
                            {{ $item['quantity'] }}
                        </span>
                        <button 
                            wire:click="updateMenuQuantity({{ $item['menu']->id_menu }}, {{ $item['quantity'] + 1 }})"
                            class="text-white bg-cocoa w-8 h-8 flex items-center justify-center rounded-full ml-2">
                            <h2 class="text-xl w-8 h-8 font-bold"><a>+</a></h2>
                        </button>
                    </div>
                </div>
                
                
            </div>
        @endforeach
    
        <!-- Total Harga -->
        <div class="fixed bottom-0 left-0 w-full bg-coconut py-4 px-4 flex justify-between items-center">
            <div class="flex justify-between items-center">
                <span class="text-cocoa font-semibold text-lg">Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.' ) }}</span>
            </div>
            
            <!-- Tombol Open Bill -->
            <button wire:click="createOrder" class="bg-cocoa text-white px-6 py-2 rounded-lg font-semibold">Open Bill</button>
        </div>
    
    </div>
</div>

