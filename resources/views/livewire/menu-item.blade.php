<div class="bg-white p-4 rounded-lg shadow-md">
    <img src="{{ $menu->gambar }}" alt="{{ $menu->nama_menu }}" class="w-full h-32 object-cover mb-4 rounded-lg">
    <h2 class="text-lg font-semibold">{{ $menu->nama_menu }}</h2>
    <p class="text-gray-600">{{ $menu->deskripsi }}</p>
    <p class="text-gray-600" data-price="{{ $menu->harga }}">
        Rp {{ number_format($menu->harga, 0, ',', '.') }}
    </p>

    <!-- Tombol Kuantitas -->
    <div class="flex items-center mt-4">
        <button type="button" wire:click="decrement" class="bg-red-500 text-white px-2 py-1 rounded-lg">-</button>
        <input type="text" wire:model="quantity" class="w-16 text-center border border-gray-300 outline-none mx-2" readonly>
        <button type="button" wire:click="increment" class="bg-green-500 text-white px-2 py-1 rounded-lg">+</button>
    </div>
</div>
