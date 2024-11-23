<div class="flex flex-col min-h-screen bg-[#EDE1D2] pb-32">
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
        <aside class="fixed top-14 left-0 w-1/4 bg-[#6A6F4C] text-white h-[calc(100vh-3.5rem)] p-4 space-y-4 overflow-y-auto">
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
        <main class="w-full md:w-3/4 ml-auto bg-[#EDE1D2] p-4 overflow-y-auto" style="margin-left: 25%;">
            @if (is_null($selectedCategory))
                <h2 class="text-2xl font-bold mb-6">Promo</h2>
                <!-- Grid Promo -->
                <div class="grid grid-cols-1 gap-4 mb-8">
                    @foreach ($promoMenus as $promo)
                        <div class="bg-[#FFF2E2] rounded-lg shadow-lg p-4 flex flex-col space-y-4">
                            <div class="flex items-center gap-4">
                                <img src="{{ $promo->gambar }}" alt="{{ $promo->nama_menu }}" class="w-16 h-16 object-cover rounded-full" />
                                <div>
                                    <h3 class="font-bold text-lg text-[#412F26]">{{ $promo->nama_menu }}</h3>
                                    <p class="text-sm text-[#806044]">{{ $promo->deskripsi }}</p>
                                    <p class="text-[#412F26] font-bold">Rp. {{ number_format($promo->harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <button 
                                wire:click="addToCart({{ $promo->id_menu }})" 
                                class="btn btn-primary bg-[#6A6F4C] text-white hover:bg-[#412F26]"
                            >
                                ADD TO CART
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif


            <h2 class="text-2xl font-bold mb-6">Menu</h2>
            <!-- Grid Horizontal Menu -->
            <div class="flex flex-wrap gap-4">
                @foreach ($menus as $menu)
                    <div class="flex-shrink-0 bg-[#FFF2E2] rounded-lg shadow-lg flex items-center space-x-4 h-24 w-full md:w-[250px]">
                        <!-- Gambar Menu -->
                        <div class="w-28 h-full bg-[#CBB89D] flex items-center justify-center">
                            <img src="{{ $menu->gambar }}" alt="{{ $menu->nama_menu }}" class="w-12 h-12 object-cover rounded-full" />
                        </div>
                        <!-- Deskripsi dan Harga Menu -->
                        <div class="flex flex-col flex-1">
                            <h3 class="font-bold text-base md:text-lg text-[#412F26]">{{ $menu->nama_menu }}</h3>
                            <p class="text-xs md:text-sm text-[#806044] whitespace-nowrap overflow-hidden text-ellipsis" title="{{ $menu->deskripsi }}">{{ $menu->deskripsi }}</p>
                            <p class="text-[#412F26] font-bold whitespace-nowrap">Rp. {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </div>
                        <!-- Tombol Quantity -->
                        <div class="flex gap-2" style="margin-right: 5px">
                            <button wire:click="decrement({{ $menu->id_menu }})" class="rounded-full bg-[#6A6F4C] text-white text-sm md:text-lg hover:bg-[#412F26] h-6 w-6">
                                -
                            </button>
                            <span class="font-bold text-[#412F26]">
                                {{ $menu->quantity ?? 0 }}
                            </span>
                            <button wire:click="increment({{ $menu->id_menu }})" class="rounded-full bg-[#6A6F4C] text-white text-sm md:text-lg hover:bg-[#412F26] h-6 w-6">
                                +
                            </button>
                        </div>
                    </div>
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
