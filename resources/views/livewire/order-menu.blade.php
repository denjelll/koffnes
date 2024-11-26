<div>
    <link rel="icon" href="{{ asset('storage/asset/gambar/icon.png') }}" type="image/png">
    @push('styles')
    <style>
        .slide {
          display: none;
        }
        .slide.active {
          display: block;
        }
    
        html {
          overflow-y: scroll;
          scrollbar-width: none; /* Untuk Firefox */
        }
    
        html::-webkit-scrollbar {
          display: none; /* Untuk Chrome, Safari, dan Edge */
        }
    
        input::placeholder {
          color: grey;
          font-style: italic;
        }
    
        body {
            background-image: url("{{ asset('storage/asset/gambar/motif.png') }}");
            background-repeat: repeat;
            background-position: top left;
            background-size: 400px 400px;
            padding-bottom: 15px;
            padding-top: 60px;
            margin: 0;
        }

        input::placeholder {
            color: brown;
        }
      </style>
    @endpush
    
    <div class="flex flex-col min-h-screen pb-32">
        <!-- Navbar -->
        <nav class="fixed top-0 left-0 right-0 flex items-center justify-between bg-[#412F26] text-white h-14 px-4 z-50 shadow-lg">
            <div class="flex items-center gap-2">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('storage/asset/gambar/koffnes_putih.png') }}" alt="Koffnes Logo" class="h-6" />
                </a>            
            </div>
        </nav>
    
        <!-- Konten -->
        <div class="flex">
            <!-- Atas -->
            <main class="w-full p-4 overflow-y-auto">
                <div class="flex flex-col lg:flex-row items-center justify-center">
                    <select
                                wire:change="fetchMenus" 
                                wire:model="selectedCategory"
                                class="p-2 w-full md:w-1/3 border bg-[#cbb89d] text-white border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-500"
                    >
                                <option value = "" class="text-white hover:underline"> Semua </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id_kategori }}" class="text-white hover:underline">
                                        {{ $category->nama_kategori }}
                                    </option>
                                @endforeach
                    </select>
                    <input
                                type="text"
                                wire:model="search" 
                                wire:keydown.enter="fetchMenus"
                                placeholder="Search menu"
                                class="p-2 w-full mt-2 md:w-1/3 bg-white rounded-lg"
                                
                    >
                </div>

                
                <!-- Menu Promo -->
                @if(!$promoMenus->isEmpty())
                    <h2 class="text-2xl font-bold mb-6 mt-6">Promo</h2>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($promoMenus as $menuPromo)
                            <div class="p-2 menu-card items-center bg-[#FFF2E2] shadow-md rounded-lg overflow-hidden w-full sm:w-3/4 md:w-1/2 lg:w-1/3 mx-auto">
                                <!-- Gambar Menu -->
                                <img class="w-full h-32 sm:h-48 object-cover" src="{{ $menuPromo->gambar }}" alt="{{ $menuPromo->nama_menu }}">

                                <div class="p-2 sm:p-4 flex flex-col h-26">
                                    <!-- Nama dan Harga Menu -->
                                    <h2 class="text-[#412f26] font-semibold text-left">{{ $menuPromo->nama_menu }}</h2>
                                    <div class="flex items-center mt-2 sm:mt-4 justify-between">
                                        <span class="font-bold text-red-500">Rp. {{ number_format($menuPromo->promo->harga_promo, 0, ',', '.') }}</span>
                                        
                                        <!-- Tombol Kuantitas -->
                                        <div class="flex items-center">

                                            <button wire:click="decrement({{ $menuPromo->id_menu }})" class="bg-cocoa text-white w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                </svg>
                                            </button>
                                            <span class="font-bold text-[#412F26] mx-2">
                                                {{ $cart[$menuPromo->id_menu]['quantity'] ?? 0 }}
                                            </span>
                                            <button wire:click="increment({{ $menuPromo->id_menu }})" class="bg-cocoa text-white w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        @endforeach
                    </div>
                @endif

                <!-- Menu -->
                <h2 class="text-2xl font-bold mb-6 mt-6">{{ $selectedCategory ? $categories[$selectedCategory - 1]->nama_kategori : 'Menu' }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                    @if($menus)
                        @foreach ($menus as $menu)
                            {{-- Jika Kategori Bundling, maka tampilkan card khusus bundling --}}
                            @if ($selectedCategory == 4) 
                                <div class="rounded-2xl mt-4 bg-[#FFF2E2] shadow-lg relative w-full md:w-[230px]">
                                    <!-- Gambar Menu -->
                                    <img src="https://www.luxcafeclub.com/cdn/shop/articles/Americano_Coffee_1200x1200.png?v=1713411608" alt="{{ $menu->nama_menu }}" class="w-full h-44 rounded-t-xl object-cover" />
                                    
                                    <!-- Nama, deskripsi, dan Harga Menu -->
                                    <div class="pt-4 pb-6 p-4">
                                        <h1 class="text-[#412f26] font-bold text-left text-sm sm:text-base">{{ $menu->nama_menu }}</h1>
                                        <p class="text-xs md:text-sm text-[#806044] mt-1">{{ $menu->deskripsi }}</p>
                                        <p class="text-[#412f26] mt-2 text-sm sm:text-base">Rp. {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                        <!-- Tombol Add To Cart -->
                                        <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4">
                                            <button wire:click="increment({{ $menu->id_menu }})" class="bg-cocoa text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto hover:bg-[#412F26]">
                                                Add To Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Card Menu Normal -->
                                <div class="p-2 menu-card bg-[#FFF2E2] shadow-md rounded-lg overflow-hidden sm:w-1/2 md:w-1/3 lg:w-1/4 mx-auto" style="width: 100%;">
                                    <!-- Gambar Menu -->
                                    <img class="w-full h-28 sm:h-44 object-cover rounded-t-lg" src="{{ $menu->gambar }}" alt="{{ $menu->nama_menu }}">

                                    <div class="p-2 sm:p-4 flex flex-col">
                                        <!-- Nama dan Harga Menu -->
                                        <h1 class="text-[#412f26] font-bold text-left text-sm sm:text-base">{{ $menu->nama_menu }}</h1>
                                        <div class="flex items-center mt-2 sm:mt-4 justify-between">
                                            @if ($menu->promo && $menu->promo->status === 'Aktif' && (now()->format('l') === $menu->promo->hari || $menu->promo->hari === 'AllDay') && now()->between($menu->promo->waktu_mulai, $menu->promo->waktu_berakhir))
                                                <span class="text-red-500 text-sm sm:text-base">Rp. {{ number_format($menu->promo->harga_promo, 0, ',', '.') }}</span>
                                            @else
                                                <span class="text-[#412f26] text-sm sm:text-base">Rp. {{ number_format($menu->harga, 0, ',', '.') }}</span>
                                            @endif

                                            <!-- Tombol Kuantitas -->
                                            <div class="flex items-center">
                                                <button wire:click="decrement({{ $menu->id_menu }})" class="bg-cocoa text-white w-5 h-5 sm:w-6 sm:h-6 rounded-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                    </svg>
                                                </button>
                                                <span class="font-bold text-[#412F26] mx-2 text-sm sm:text-base">
                                                    {{ $cart[$menu->id_menu]['quantity'] ?? 0 }}
                                                </span>
                                                <button wire:click="increment({{ $menu->id_menu }})" class="bg-cocoa text-white w-5 h-5 sm:w-6 sm:h-6 rounded-full flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none" viewbox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p class="text-gray-500 mt-4">Menu tidak ditemukan. Coba lihat menu yang lain.</p>
                    @endif
                </div>
            </main>
        </div>
    
        <!-- Footer -->
        <footer class="fixed bottom-0 left-0 right-0 bg-[#412F26] text-white p-4 text-center shadow-lg">
            <div class="container mx-auto flex flex-col items-center">
                <h3 class="text-lg font-semibold mb-2">Total Harga: Rp{{ number_format($totalHarga, 0, ',', '.') }}</h3>
                <form method="GET" action="{{ route('checkout', ['nomorMeja' => $nomorMeja]) }}">
                    <button type="submit" class="btn btn-primary mt-2 px-6 py-2 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 bg-white text-[#412F26] hover:bg-[#6a6f4c] hover:text-white border-none shadow-lg active:scale-95">
                        Checkout
                    </button>
                </form>
            </div>
        </footer>
    </div>

</div>