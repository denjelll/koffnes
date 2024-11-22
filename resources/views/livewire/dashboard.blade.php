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
                                wire:click="approveOrder({{ $order->id_order }})"
                                class="px-2 py-1 bg-green-500 text-white rounded">
                                Approve
                            </button>
                            <button
                                wire:click="editOrder({{ $order->id_order }})"
                                class="px-2 py-1 bg-blue-500 text-white rounded">
                                Edit
                            </button>
                            <button
                                wire:click="approveOrder({{ $order->id_order }})"
                                class="px-2 py-1 bg-red-500 text-white rounded">
                                Delete
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

</div>
