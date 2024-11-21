<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Selamat Datang, {{ $customer }}</h1>
    <h2 class="text-xl font-semibold mb-4">Nomor Meja: {{ $nomorMeja }}</h2>

    <!-- Sidebar Kategori dan Daftar Menu -->
    <div class="flex">
        <!-- Sidebar Kategori -->
        <aside class="w-1/4 border-r pr-4">
            <h3 class="text-lg font-semibold mb-2">Kategori</h3>
            <ul>
                <li>
                    <button wire:click="filterByCategory(null)" class="text-blue-500">
                        Semua
                    </button>
                </li>
                @foreach ($categories as $category)
                    <li>
                        <button wire:click="filterByCategory({{ $category->id_kategori }})" class="text-blue-500">
                            {{ $category->nama_kategori }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </aside>

        <div class="w-3/4 pl-4">
            {{-- Daftar menu yang sedang promo --}}
            @if (is_null($selectedCategory))
                <div>
                    <h2 class="text-xl font-bold mb-4">Promo Hari Ini</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($promoMenus as $menu)
                            <div class="border p-4 rounded-lg shadow">
                                <img src="{{ $menu->gambar }}" alt="{{ $menu->nama_menu }}" class="w-full h-32 object-cover mb-4 rounded-lg">
                                <h3 class="text-lg font-bold">{{ $menu->nama_menu }}</h3>
                                <p class="text-gray-600">
                                    <span class="text-red-500 font-bold">Rp {{ number_format($menu->promo->harga_promo, 0, ',', '.') }}</span>
                                </p>
                                
                                <div class="flex items-center mt-2">
                                    <button wire:click="decrement({{ $menu->id_menu }})" class="bg-red-500 text-white px-2 py-1 rounded">-</button>
                                    <span class="mx-2">{{ $cart[$menu->id_menu]['quantity'] ?? 0 }}</span>
                                    <button wire:click="increment({{ $menu->id_menu }})" class="bg-green-500 text-white px-2 py-1 rounded">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Daftar Menu -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($menus as $menu)
                    <div class="border p-4 rounded-lg shadow">
                        <img src="{{ $menu->gambar }}" alt="{{ $menu->nama_menu }}" class="w-full h-32 object-cover mb-4 rounded-lg">
                        <h3 class="text-lg font-bold">{{ $menu->nama_menu }}</h3>
                        <p class="text-gray-600">
                            @if ($menu->promo && $menu->promo->status === 'Aktif' &&
                                 (now()->format('l') === $menu->promo->hari || $menu->promo->hari === 'AllDay') &&
                                 now()->between($menu->promo->waktu_mulai, $menu->promo->waktu_berakhir))
                                <span class="text-red-500 font-bold">Rp {{ number_format($menu->promo->harga_promo, 0, ',', '.') }}</span>
                            @else
                                Rp {{ number_format($menu->harga, 0, ',', '.') }}
                            @endif
                        </p>
                        
                        <div class="flex items-center mt-2">
                            <button wire:click="decrement({{ $menu->id_menu }})" class="bg-red-500 text-white px-2 py-1 rounded">-</button>
                            <span class="mx-2">{{ $cart[$menu->id_menu]['quantity'] ?? 0 }}</span>
                            <button wire:click="increment({{ $menu->id_menu }})" class="bg-green-500 text-white px-2 py-1 rounded">+</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Total Harga -->
    <div class="mt-4">
        <h3 class="text-lg font-semibold">Total Harga: Rp{{ number_format($totalHarga, 0, ',', '.') }}</h3>
    </div>

    <!-- Tombol Checkout -->
    <form method="GET" action="{{ route('checkout', ['nomorMeja' => $nomorMeja]) }}">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg mt-4">
            Checkout
        </button>
    </form>
</div>