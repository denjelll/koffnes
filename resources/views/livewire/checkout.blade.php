<div class="p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Checkout</h2>

    <!-- Daftar Item di Cart -->
    @foreach($cartItems as $item)
        <div class="border-b pb-4 mb-4">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-700">{{ $item['menu']->nama_menu }}</h3>
                <p class="text-sm text-gray-500">Rp {{ number_format($item['menu']->harga) }}</p>
            </div>

           <!-- List Add-On dalam bentuk card -->
           @if(!empty($item['addOn']))
           <div class="mt-4">
               <label class="block text-sm font-medium text-gray-600 mb-2">Tambahkan Add-On</label>
               <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-2">
                   @foreach ($item['addOn'] as $addon)
                       <div class="p-4 border rounded-lg shadow-sm">
                           <h5 class="font-medium">{{ $addon['nama_addon'] }} Rp {{ number_format($addon['harga'], 0, ',', '.') }}</h5>
                           <div class="flex items-center mt-2">
                               <!-- Tombol Kurangi -->
                               <button 
                                   class="bg-red-500 text-white px-3 py-1 rounded-l hover:bg-red-600"
                                   wire:click="updateAddonQuantity('{{ $item['menu']['id_menu'] }}', '{{ $addon['id_addon'] }}', 'decrement')">
                                   -
                               </button>
                               <!-- Kuantitas -->
                               <span class="px-4 py-1 border-t border-b">{{ $addon['quantity'] ?? 0 }}</span>
                               <!-- Tombol Tambah -->
                               <button 
                                   class="bg-green-500 text-white px-3 py-1 rounded-r hover:bg-green-600"
                                   wire:click="updateAddonQuantity('{{ $item['menu']['id_menu'] }}', '{{ $addon['id_addon'] }}', 'increment')">
                                   +
                               </button>
                           </div>
                           <p class="mt-2 text-sm font-medium text-gray-700">
                               Total: Rp {{ number_format(($addon['quantity'] ?? 0) * $addon['harga'], 0, ',', '.') }}
                           </p>
                       </div>
                   @endforeach
               </div>
           </div>
           @endif
           
            <!-- Notes -->
            <div class="mt-2">
                <label for="notes-{{ $loop->index }}" class="block text-sm font-medium text-gray-600">Catatan (Opsional)</label>
                <textarea id="notes-{{ $loop->index }}" wire:model="cartItems.{{ $loop->index }}.notes" class="textarea textarea-bordered w-full mt-1" placeholder="Masukkan catatan untuk menu ini"></textarea>
            </div>

            <!-- Kuantitas -->
            <div class="mt-4 flex items-center space-x-4">
                <button 
                    wire:click="updateMenuQuantity('{{ $item['menu']->id_menu }}', {{ $item['quantity'] - 1 }})"
                    class="btn btn-outline btn-sm text-gray-600"
                    :disabled="{{ $item['quantity'] <= 1 ? 'true' : 'false' }}">
                    -
                </button>
                <input 
                    type="number"
                    wire:change="updateMenuQuantity('{{ $item['menu']->id_menu }}', $event.target.value)"
                    value="{{ $item['quantity'] }}"
                    class="input input-bordered w-16 text-center"
                    min="0" />
                <button 
                    wire:click="updateMenuQuantity('{{ $item['menu']->id_menu }}', {{ $item['quantity'] + 1 }})"
                    class="btn btn-outline btn-sm text-gray-600">
                    +
                </button>
            </div>
            
            
        </div>
    @endforeach

    <!-- Total Harga -->
    <div class="mt-4 border-t pt-4">
        <div class="flex justify-between items-center">
            <span class="font-semibold text-lg">Total Harga:</span>
            <span class="text-lg text-gray-800">Rp {{ number_format($totalHarga) }}</span>
        </div>
    </div>

    <!-- Tombol Submit -->
    <div class="mt-6">
        <button wire:click="createOrder" class="btn btn-primary w-full">Buat Pesanan</button>
    </div>
</div>
