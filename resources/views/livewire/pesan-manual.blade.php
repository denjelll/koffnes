<div>
    <h1 class="text-center font-bold text-4xl">Pesanan Manual</h1>
    <a href="cashier/dashboard" class="m-5 border border-black">Dashboard</a>
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
    
                <!-- Add-Ons Terkait -->
                @if ($item->addOns->count() > 0)
                    <div class="mt-4 border-t border-black pt-2">
                        <h3 class="font-bold text-lg">Add Ons</h3>
                        <div class="grid grid-cols-3 gap-4">
                            @foreach ($item->addOns as $addon)
                                <div class="bg-blue-200 p-2" wire:key="addon-{{ $addon->id_addon }}">
                                    <p>{{ $addon->nama_addon }}</p>
                                    <p>Rp. {{ number_format($addon->harga, 0, ',', '.') }}</p>
    
                                    <!-- Kuantitas Add-On -->
                                    <div class="flex justify-center">
                                        <button class="m-2 text-xl px-5 bg-red-500" wire:click="kurangAddon('{{ $addon->id_addon }}')">-</button>
                                        <input type="number" class="text-center" min="0" wire:model.debounce.500ms="qtyAddOns.{{ $addon->id_addon }}"/>
                                        <button class="m-2 text-xl px-5 bg-green-500" wire:click="tambahAddon('{{ $addon->id_addon }}')">+</button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    

    <div class="border border-black m-5 p-3 flex justify-between">
        <h2 class="text-2xl font-bold">Total Harga: Rp. {{ number_format($totalHarga, 0, ',', '.') }}</h2>
        <!-- Inputan Data Customer -->
        <div>
            <div>
                <label>Nama</label>
                <input type="text" class="border border-black" wire:model="customer" required />
            </div>
            
            <div>
                <label for="Dine In">Dine In</label>
                <input type="radio" id="Dine In" name="tipeOrder" value="Dine In" wire:model="tipeOrder" required />
                
                <label for="Take Away">Take Away</label>
                <input type="radio" id="Take Away" name="tipeOrder" value="Take Away" wire:model="tipeOrder" required />
            </div>
        
            <div>
                <label>Table</label>
                <input type="number" class="border border-black" wire:model="meja" 
                    @if($tipeOrder === 'Take Away') 
                        disabled
                    @elseif($tipeOrder === 'Dine In') 
                        min="1" max="21" 
                    @endif
                    required />
            </div>
        </div>
        
        
        <button wire:click="confirmOrder">Confirm</button>
    </div>
    
</div>