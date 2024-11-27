<div>
    <h1 class="text-xl text-center font-bold">List Transaksi</h1>

   <!-- Navigation -->
    <div class="flex justify-center space-x-4 my-4">
        <button 
            wire:click="switchTab('Open Bill')" 
            class="px-4 py-2 {{ $currentTab === 'Open Bill' ? 'bg-blue-500 text-white' : 'bg-gray-200'}} rounded">
            Open Bill
        </button>
        <button 
            wire:click="switchTab('Paid')" 
            class="px-4 py-2 {{ $currentTab === 'Paid' ? 'bg-blue-500 text-white' : 'bg-gray-200'}} rounded">
            Paid
        </button>
        <button 
            wire:click="switchTab('Cancelled')" 
            class="px-4 py-2 {{ $currentTab === 'Cancelled' ? 'bg-blue-500 text-white' : 'bg-gray-200'}} rounded">
            Cancelled
        </button>
    </div>

    <!-- Tabel -->
    <div class="border border-black p-3 m-5">
        <h1 class="text-xl font-bold">{{ $currentTab }}</h1>
        <table class="border border-collapse w-full">
            <tr class="text-left">
                <th>Order ID</th>
                <th>No Antrian</th>
                <th>Nama Customer</th>
                <th>No Meja</th>
                <th>Tipe Order</th>
                <th>Status</th>
                <th>Harga Total</th>
                <th>Waktu Transaksi</th>
            </tr>
            
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id_order }}</td>
                    <td>{{ $order->antrian }}</td>
                    <td>{{ $order->customer }}</td>
                    <td>{{ $order->meja }}</td>
                    <td>{{ $order->tipe_order }}</td>
                    <td>{{ $order->status }}</td>
                    <td>Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $order->waktu_transaksi }}</td>

                    <!-- Tombol CRUD -->
                    @if ($currentTab === 'Open Bill')
                        <td>
                            <button
                                wire:click="approveOrder('{{ $order->id_order }}')"
                                class="px-2 py-1 bg-green-500 text-white rounded">
                                Approve
                            </button>
                            <button
                                wire:click="editOrder('{{ $order->id_order }}')"
                                class="px-2 py-1 bg-blue-500 text-white rounded">
                                Edit
                            </button>
                            <button
                                wire:click="cancelOrder('{{ $order->id_order }}')"
                                class="px-2 py-1 bg-red-500 text-white rounded">
                                Cancel
                            </button>
                            <button
                                wire:click="printReceipt('{{ $order->id_order }}')"
                                class="px-2 py-1 bg-cocoa text-white rounded">
                                Print Receipt
                            </button>
                        </td>
                    @endif

                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak Ada Data</td>
                </tr>
            @endforelse
        </table>
    </div>

    <form action="{{ route('daily.report') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Daily Report</button>
    </form>
    

    <!-- Pop Up -->
    <div>
        @if ($isModalOpen)
            <div class="fixed inset-0 bg-gray-800 bg-opacity-75 z-50">
                <div class="bg-white rounded-lg shadow-lg max-w-2xl mx-auto p-4">
                    <h2 class="text-lg font-bold mb-4">Edit Pesanan</h2>
                    <h3 class="font-semibold">Menu Utama</h3>
                    <div>
                        @foreach ($menuItems as $menu)
                            <div class="flex items-center justify-between">
                                <span>{{ $menu->menu->nama_menu }}</span>
                                <div>
                                    <button wire:click="decreaseQuantity('{{ $menu->id_detailorder }}')" class="bg-gray-300 px-2">-</button>
                                    <input type="text" wire:model="quantities.{{ $menu->id_detailorder }}" class="w-12 text-center border">
                                    <button wire:click="increaseQuantity('{{ $menu->id_detailorder }}')" class="bg-gray-300 px-2">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    <h3 class="font-semibold mt-4">Add-Ons</h3>
                    <div>
                        @foreach ($addOns as $addon)
                            <div class="flex items-center justify-between">
                                <span>{{ $addon->addon->nama_addon }}</span>
                                <div>
                                    <button wire:click="decreaseAddonQuantity('{{ $addon->id_detailaddon }}')" class="bg-gray-300 px-2">-</button>
                                    <input type="text" wire:model="addonQuantities.{{ $addon->id_detailaddon }}" class="w-12 text-center border">
                                    <button wire:click="increaseAddonQuantity('{{ $addon->id_detailaddon }}')" class="bg-gray-300 px-2">+</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    <div class="mt-4">
                        <button wire:click="saveOrder" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                        <button wire:click="$set('isModalOpen', false)" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                    </div>
                </div>
            </div>
        @endif
    </div>
    
</div>
