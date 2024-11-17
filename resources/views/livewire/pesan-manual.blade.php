<div>
    <h1 class="text-center font-bold text-4xl">Pesanan Manual</h1>
    <div class="border border-black m-5 p-3 grid grid-cols-3 gap-4">
        @foreach ($items as $item)
        <!-- List Menu -->
            <div class="bg-green-300 m-2 p-5" wire:key="menu-{{ $item->id_menu }}">
                <img loading="lazy" src="#" alt="foto di sini"/>
                <p class="font-bold text-2xl">{{ $item->nama_menu }}</p>
                <p>Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>

                <!-- Kuantitas -->
                <div class="flex justify-center">
                    <button class="m-2 text-xl px-5 bg-red-500" wire:click="kurang('{{ $item->id_menu }}')">-</button>
                    <input type="number" class="text-center" min="0" wire:model.debounce.500ms="qty.{{ $item->id_menu }}"/>
                    <button class="m-2 text-xl px-5 bg-green-500" wire:click="tambah('{{ $item->id_menu }}')">+</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="border border-black m-5 p-3 flex justify-between">
        <h2 class="text-2xl font-bold">Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h2>
        <button class="text-2xl bg-green-500 p-1">Simpan</button>
    </div>
</div>
