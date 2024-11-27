<div>
    <h1 class="text-center font-bold text-4xl">Pesanan Manual</h1>
    <a href="cashier/dashboard" class="m-5 border border-black">Dashboard</a>

    <!-- Input Data Customer -->
    <div class="border border-black m-5 p-3">
        <h2 class="font-bold text-2xl">Informasi Customer</h2>
        <div class="mb-4">
            <label class="block font-bold">Nama Customer:</label>
            <input type="text" class="w-full border p-2" wire:model.defer="customer.nama" placeholder="Masukkan nama customer" />
        </div>
        <div class="mb-4">
            <label class="block font-bold">Tipe Order:</label>
            <select class="w-full border p-2" wire:model="customer.tipe_order">
                <option value="Dine In">Dine In</option>
                <option value="Take Away">Take Away</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-bold">Nomor Meja:</label>
            <input type="number" class="w-full border p-2" wire:model="customer.meja" placeholder="Masukkan nomor meja" />
        </div>
    </div>


    <h1 class="font-bold text-2xl m-5">Menu Utama</h1>
    <div class="border border-black m-5 p-3 gap-4">
        @foreach ($items as $item)
            <!-- Menu Utama -->
            <div class="bg-green-300 m-2 p-5" wire:key="menu-{{ $item->id_menu }}">
                <img loading="lazy" src="{{ $item->gambar }}" alt="Foto menu {{ $item->nama_menu }}"/>
                <p class="font-bold text-2xl">{{ $item->nama_menu }}</p>
                <p>Rp. {{ number_format($item->harga, 0, ',', '.') }}</p>
    
                <!-- Kuantitas -->
                <div class="flex justify-center">
                    <button class="m-2 text-xl px-5 bg-red-500" wire:click="kurangMenu('{{ $item->id_menu }}')">-</button>
                    <input type="number" class="text-center" min="0" wire:model.debounce.500ms="qtyMenu.{{ $item->id_menu }}"/>
                    <button class="m-2 text-xl px-5 bg-green-500" wire:click="tambahMenu('{{ $item->id_menu }}')">+</button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="border border-black m-5 p-3 flex justify-between">
        <h2 class="text-2xl font-bold">Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h2>
        
        

        <button class="bg-blue-500 text-white px-4 py-2" wire:click="confirmOrder">Confirm</button>
    </div>
</div>