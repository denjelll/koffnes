<div>
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
            padding-bottom: 80px;
            padding-top: 60px;
            margin: 0;
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
                <input 
                    type="text" 
                    placeholder="Search Menu..." 
                    class="input input-bordered input-sm bg-white text-black rounded-lg focus:outline-none"
                />
            </div>
        </nav>
    
        <!-- Sidebar dan Konten -->
        <div class="flex pt-16">
            <!-- Sidebar -->
            <aside class="fixed top-14 left-0 w-1/4 bg-natural text-white h-[calc(100vh-3.5rem)] p-4 space-y-4 overflow-y-auto">
                <h3 class="text-lg font-semibold mb-2">Kategori</h3>
                <ul class="space-y-2">
                    <li>
                        <button wire:click="filterByCategory(null)" class="text-white hover:underline">
                            Semua
                        </button>
                    </li>
                    @foreach ($categories as $category)
                        <li>
                            <button wire:click="filterByCategory({{ $category->id_kategori }})" class="text-white hover:underline">
                                {{ $category->nama_kategori }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </aside>
    
            <!-- Konten -->
            <main class="w-full md:w-3/4 ml-auto p-4 overflow-y-auto" style="margin-left: 25%;">
                @if (is_null($selectedCategory))
                <!-- Menu Promo -->
                    @if(!$promoMenus->isEmpty())
                        <h2 class="text-2xl font-bold mb-6">Promo</h2>
                        <div class="grid grid-cols-1 gap-4 mb-8">
                            @foreach ($promoMenus as $menuPromo)
                                <div class="flex-shrink-0 bg-[#FFF2E2] rounded-lg shadow-lg flex items-center space-x-4 h-36 w-full md:w-[250px]">
                                    <!-- Gambar Menu -->
                                    <div class="w-28 h-full bg-[#CBB89D] flex items-center justify-center rounded-l-lg">
                                        <img src="{{ $menuPromo->gambar }}" alt="{{ $menuPromo->nama_menu }}" class="w-full h-full rounded-l-lg " />
                                    </div>
                                    <!-- Deskripsi dan Harga Menu -->
                                    <div class="flex flex-col flex-1">
                                        <h3 class="font-bold text-base md:text-lg text-[#412F26]">{{ $menuPromo->nama_menu }}</h3>
                                        <p class="text-red-500 font-semibold whitespace-nowrap">Rp. {{ number_format($menuPromo->promo->harga_promo, 0, ',', '.') }}</p>
                                    </div>
                                    <!-- Tombol Quantity -->
                                    <div class="flex gap-2" style="margin-right: 12px">
                                        <button wire:click="decrement({{ $menuPromo->id_menu }})" class="flex items-center justify-center rounded-full bg-cocoa text-white text-sm md:text-lg hover:bg-[#412F26] h-6 w-6">
                                            -
                                        </button>
                                        <span class="font-bold text-[#412F26]">
                                            {{ $cart[$menuPromo->id_menu]['quantity'] ?? 0 }}
                                        </span>
                                        <button wire:click="increment({{ $menuPromo->id_menu }})" class="flex items-center justify-center rounded-full bg-cocoa text-white text-sm md:text-lg hover:bg-[#412F26] h-6 w-6">
                                            +
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    
                    {{-- Card Bundling --}}
                    @if ($bundlingMenu)
                        <h2 class="text-2xl font-bold mb-6">Bundling</h2>
                        <div class="rounded-2xl mt-4 bg-[#FFF2E2] shadow-lg relative">
                            <!-- Gambar Menu -->
                            <img
                                src="{{ $bundlingMenu->gambar }}"
                                alt="{{ $bundlingMenu->nama_menu }}"
                                class="w-full h-48 rounded-t-xl object-cover"
                            />

                            <!-- Deskripsi Menu -->
                            <div class="pt-4 pb-6 p-4">
                                <h3 class="text-lg md:text-xl font-semibold text-[#412F26]">
                                    {{ $bundlingMenu->nama_menu }}
                                </h3>
                                <p class="text-cocoa text-lg md:text-xl font-bold">Rp {{ number_format($bundlingMenu->harga, 0, ',', '.') }}</p>
                                <p class="text-sm md:text-base text-[#806044] mt-1">
                                    {{ $bundlingMenu->deskripsi }}
                                </p>

                                <!-- Tombol Add To Cart -->
                                <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4">
                                    <button wire:click="increment({{ $bundlingMenu->id_menu }})" 
                                            class="bg-[#6A6F4C] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto hover:bg-[#412F26]">
                                        Add To Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                @endif
    
    
                <h2 class="text-2xl font-bold mb-6">{{ $categories[$selectedCategory - 1]->nama_kategori ?? 'Menu' }}</h2>
                <!-- Menu -->
                <div class="flex flex-wrap gap-4">
                    @foreach ($menus as $menu)
                        {{-- Jika Kategori Bundling, maka tampilkan card khusus bundling --}}
                        @if ($selectedCategory === 4 && !empty($bundlingMenu)) 
                            <div class="rounded-2xl mt-4 bg-[#FFF2E2] shadow-lg relative w-full md:w-[250px]">
                                <!-- Gambar Menu -->
                                <img src="{{ $menu->gambar }}" alt="{{ $menu->nama_menu }}" class="w-full h-48 rounded-t-xl object-cover" />
                                <!-- Deskripsi Menu -->
                                <div class="pt-4 pb-6 p-4">
                                    <h3 class="text-lg md:text-xl font-semibold text-[#412F26]">{{ $menu->nama_menu }}</h3>
                                    <p class="text-cocoa text-lg md:text-xl font-bold">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    <p class="text-sm md:text-base text-[#806044] mt-1">{{ $menu->deskripsi }}</p>
                                    <!-- Tombol Add To Cart -->
                                    <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4">
                                        <button wire:click="increment({{ $menu->id_menu }})" class="bg-[#6A6F4C] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto hover:bg-[#412F26]">
                                            Add To Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @else 
                            <div class="flex-shrink-0 bg-[#FFF2E2] rounded-lg shadow-lg flex items-center space-x-4 h-36 w-full md:w-[250px]">
                                <!-- Gambar Menu -->
                                <div class="w-28 h-full bg-[#CBB89D] flex items-center justify-center rounded-l-lg">
                                    <img src="{{ $menu->gambar }}" alt="{{ $menu->nama_menu }}" class="w-full h-full rounded-l-lg " />
                                </div>
                                <!-- Deskripsi dan Harga Menu -->
                                <div class="flex flex-col flex-1">
                                    <h3 class="font-bold text-base md:text-lg text-[#412F26]">{{ $menu->nama_menu }}</h3>
                                    @if ($menu->promo && $menu->promo->status === 'Aktif' && (now()->format('l') === $menu->promo->hari || $menu->promo->hari === 'AllDay') && now()->between($menu->promo->waktu_mulai, $menu->promo->waktu_berakhir))
                                        <p class="text-red-500 font-semibold whitespace-nowrap">Rp. {{ number_format($menu->promo->harga_promo, 0, ',', '.') }}</p>
                                    @else
                                        <p class="text-[#412F26] font-semibold whitespace-nowrap">Rp. {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                    @endif
                                </div>
                                <!-- Tombol Quantity -->
                                <div class="flex gap-2" style="margin-right: 12px">
                                    <button wire:click="decrement({{ $menu->id_menu }})" class="flex items-center justify-center rounded-full bg-cocoa text-white text-sm md:text-lg hover:bg-[#412F26] h-6 w-6">
                                        -
                                    </button>
                                    <span class="font-bold text-[#412F26]">
                                        {{ $cart[$menu->id_menu]['quantity'] ?? 0 }}
                                    </span>
                                    <button wire:click="increment({{ $menu->id_menu }})" class="flex items-center justify-center rounded-full bg-cocoa text-white text-sm md:text-lg hover:bg-[#412F26] h-6 w-6">
                                        +
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
    
            </main>
        </div>
    
        <!-- Footer -->
        <footer class="fixed bottom-0 left-0 right-0 bg-[#412F26] text-white p-4 text-center shadow-lg">
            <div class="container mx-auto flex flex-col items-center">
                <h3 class="text-lg font-semibold mb-2">Total Harga: Rp{{ number_format($totalHarga, 0, ',', '.') }}</h3>
                <form method="GET" action="{{ route('checkout', ['nomorMeja' => $nomorMeja]) }}">
                    <button type="submit" class="btn btn-primary mt-2 px-6 py-2 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 bg-[#6A6F4C] hover:bg-[#412F26] border-none shadow-lg">
                        Checkout
                    </button>
                </form>
            </div>
        </footer>
    </div>

</div>
