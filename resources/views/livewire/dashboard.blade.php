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
            <tr>
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
                    <td>'{{ $order->id_order }}'</td>
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
    @if($isModalOpen)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex justify-center items-center z-50">
        <div class="bg-white p-6 rounded-lg w-1/2">
            <h2 class="text-xl font-bold mb-4">Edit Order</h2>
    
            <!-- Menampilkan menu yang dipesan -->
            <div class="mt-4">
                <h4 class="text-lg font-semibold">Menu:</h4>
                @foreach ($menuItems as $detail)
                    <div class="flex justify-between items-center my-2">
                        <label>{{ $detail->menu->nama_menu }}</label>
                        <div class="flex items-center space-x-2">
                            <!-- Tombol Kurangi Kuantitas -->
                            <button 
                                wire:click="decreaseQuantity('{{ $detail->id_menu }}')" 
                                class="px-2 py-1 bg-red-500 text-white rounded">
                                -
                            </button>
                    
                            <!-- Input Kuantitas -->
                            <input 
                                type="number" 
                                wire:model="quantities.{{ $detail->id_menu }}" 
                                value="{{ $detail->kuantitas }}" 
                                min="1" 
                                class="border border-gray-300 rounded px-2 py-1 text-center w-16" 
                                readonly />
                    
                            <!-- Tombol Tambah Kuantitas -->
                            <button 
                                wire:click="increaseQuantity('{{ $detail->id_menu }}')" 
                                class="px-2 py-1 bg-green-500 text-white rounded">
                                +
                            </button>
                        </div>
                    </div>
    
                    <!-- Menampilkan add-on untuk setiap menu -->
                    <h5 class="mt-2 text-md font-semibold">Add-Ons:</h5>
                    @foreach ($detail->detailAddon as $addonDetail)
                        <div class="flex justify-between items-center my-2">
                            <label>{{ $addonDetail->addon->nama_addon }}</label>
                            <div class="flex items-center space-x-2">
                                <!-- Tombol Kurangi Kuantitas -->
                                <button 
                                    wire:click="decreaseQuantity('{{ $addonDetail->id_addon }}')" 
                                    class="px-2 py-1 bg-red-500 text-white rounded">
                                    -
                                </button>
                        
                                <!-- Input Kuantitas -->
                                <input 
                                    type="number" 
                                    wire:model="quantities.{{ $addonDetail->id_addon }}" 
                                    value="{{ $addonDetail->kuantitas }}" 
                                    min="1" 
                                    class="border border-gray-300 rounded px-2 py-1 text-center w-16" 
                                    readonly />
                        
                                <!-- Tombol Tambah Kuantitas -->
                                <button 
                                    wire:click="increaseQuantity('{{ $addonDetail->id_addon }}')" 
                                    class="px-2 py-1 bg-green-500 text-white rounded">
                                    +
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
    
            <!-- Tombol Save dan Close -->
            <div class="mt-4 flex justify-end">
                <button wire:click="saveOrder" class="px-4 py-2 bg-green-500 text-white rounded">Save Changes</button>
                <button wire:click="$set('isModalOpen', false)" class="ml-2 px-4 py-2 bg-gray-500 text-white rounded">Close</button>
            </div>
        </div>
    </div>
    @endif
    
</div>
