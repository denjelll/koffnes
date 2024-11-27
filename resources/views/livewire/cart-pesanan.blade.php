<div>
    <h1 class="text-center font-bold text-4xl">Cart Pesanan</h1>
    <div class="border border-black m-5 p-3">
        @foreach ($pesanan as $item)
            <div class="border p-3 m-2">
                <p class="text-xl font-bold">{{ $item['nama_menu'] }}</p>
                <p>Harga: Rp. {{ number_format($item['harga'], 0, ',', '.') }}</p>
                <p>Total Item: Rp. {{ number_format($item['total'], 0, ',', '.') }}</p>

                <div class="flex items-center">
                    <button class="m-2 text-xl px-5 bg-red-500" wire:click="kurangQty({{ $item['id_menu'] }})">-</button>
                    <span>{{ $item['kuantitas'] }}</span>
                    <button class="m-2 text-xl px-5 bg-green-500" wire:click="tambahQty({{ $item['id_menu'] }})">+</button>
                    <button class="m-2 text-xl px-5 bg-gray-500" wire:click="hapusItem({{ $item['id_menu'] }})">Hapus</button>
                </div>

                @if (isset($addOns[$item['id_menu']]) && $addOns[$item['id_menu']]->isNotEmpty())
                    <div class="mt-4">
                        <p class="text-lg font-bold">Add-Ons:</p>
                        @foreach ($addOns[$item['id_menu']] as $addon)
                            <div class="flex items-center border p-2 mt-2">
                                <p class="flex-grow">{{ $addon->nama_addon }} (Rp. {{ number_format($addon->harga, 0, ',', '.') }})</p>
                                <button class="m-2 text-xl px-5 bg-red-500" wire:click="kurangAddOnQty({{ $addon->id_addon }})">-</button>
                                <span>{{ $addOnQty[$addon->id_addon] }}</span>
                                <button class="m-2 text-xl px-5 bg-green-500" wire:click="tambahAddOnQty({{ $addon->id_addon }})">+</button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <div class="mt-4 border-t-2 border-black pt-3 justify-between flex">
        <h2 class="text-2xl font-bold">Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h2>
        <div class="mt-4 text-center">
            <button 
                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                wire:click="openBill">
                Open Bill
            </button>
        </div>
        
        @if (session()->has('success'))
            <div class="mt-3 text-green-500">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session()->has('error'))
            <div class="mt-3 text-red-500">
                {{ session('error') }}
            </div>
        @endif
    </div>
</div>