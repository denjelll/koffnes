@extends('layout.admin_navbar')
@section('title')
    Transaction Detail
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Transaction Detail
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <p class="text-gray-700"><strong>Tanggal Transaksi:</strong> {{ date('d F Y H:i', strtotime($order->waktu_transaksi)) }}</p>
            <p class="text-gray-700"><strong>ID Order:</strong> {{ $order->id_order }}</p>
            <p class="text-gray-700"><strong>Nama Customer:</strong> {{ $order->customer }}</p>
            <p class="text-gray-700"><strong>Nomor Meja:</strong> {{ $order->meja }}</p>
            <p class="text-gray-700"><strong>Tipe Order:</strong> {{ $order->tipe_order }}</p>
            <p class="text-gray-700"><strong>Kasir:</strong> {{ $order->cashier->nama }}</p>
        </div>
        @foreach ($order->detailOrders as $detail)
            <strong class="text-black">{{$detail->menu->nama_menu}}</strong>
            <div class="flex justify-between">
                <p class="text-black">{{$detail->kuantitas}} x @ {{$detail->harga_menu}}</p>
                <p class="text-black">{{ number_format($detail->harga_menu*$detail->kuantitas, 0, ',', '.') }}</p>
            </div>
            @if ($detail->detailAddon != null)
            @foreach ($detail->detailAddon as $addon)
            <div class="flex justify-between">
                <p class="text-black">{{$addon->kuantitas}} x {{$addon->addon->nama_addon}} @ {{$addon->harga}} </p>
                <p class="text-black">+ {{ number_format($addon->harga * $addon->kuantitas, 0, ',', '.') }}</p>
            </div>
            @endforeach
            @endif
            @if($detail->notes != null) 
            <div class="flex justify-between">
                <p class="text-black">Notes: {{$detail->notes}}</p>
            </div>
            @endif
            @endforeach
        <div class="mt-6">
            <div class="flex justify-between">
                <p class="font-semibold text-black"><strong>Total Harga :</strong></p>
                <p class="font-semibold text-black">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between">
                <p class="font-semibold text-black"><strong>Bayar :</strong></p>
                <p class="font-semibold text-black">Rp{{ number_format($order->bayar, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between">
                <p class="font-semibold text-black"><strong>Kembalian :</strong></p>
                <p class="font-semibold text-black">Rp{{ number_format($order->kembalian, 0, ',', '.') }}</p>
            </div>

        </div>
        <div class="mt-6">
            <button onclick="showPrintModal()" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Print
            </button>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="printModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6 w-3/4 max-h-[80vh] overflow-y-auto">
        <h2 class="text-xl font-semibold mb-4">Print Preview</h2>
        <div id="printContent">
            <div class="mb-4">
                <p class="text-black"><strong>Tanggal Transaksi:</strong> {{ date('d F Y', strtotime($order->waktu_transaksi)) }}</p>
                <p class="text-black"><strong>ID Order:</strong> {{ $order->id_order }}</p>
                <p class="text-black"><strong>Nama Customer:</strong> {{ $order->customer }}</p>
                <p class="text-black"><strong>Nomor Meja:</strong> {{ $order->meja }}</p>
                <p class="text-black"><strong>Tipe Order:</strong> {{ $order->tipe_order }}</p>
                <p class="text-black"><strong>Kasir:</strong> {{ $order->cashier->nama }}</p>
            </div>
            @foreach ($order->detailOrders as $detail)
            <strong class="text-black">{{$detail->menu->nama_menu}}</strong>
            <div class="flex justify-between">
                <p class="text-black">{{$detail->kuantitas}} x @ {{$detail->harga_menu}}</p>
                <p class="text-black">{{ number_format($detail->harga_menu*$detail->kuantitas, 0, ',', '.') }}</p>
            </div>
            @if ($detail->detailAddon != null)
                @foreach ($detail->detailAddon as $addon)
                <div class="flex justify-between">
                <p class="text-black">{{$addon->kuantitas}} x {{$addon->addon->nama_addon}} @ {{$addon->harga}} </p>
                <p class="text-black">+ {{ number_format($addon->harga * $addon->kuantitas, 0, ',', '.') }}</p>
                </div>
                @endforeach
            @endif
            @if($detail->notes != null) 
            <div class="flex justify-between">
                <p class="text-black">Notes: {{$detail->notes}}</p>
            </div>
            @endif
            @endforeach
        <div class="mt-6">
            <div class="flex justify-between">
                <p class="font-semibold text-black"><strong>Total Harga :</strong></p>
                <p class="font-semibold text-black">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between">
                <p class="font-semibold text-black"><strong>Bayar :</strong></p>
                <p class="font-semibold text-black">Rp{{ number_format($order->bayar, 0, ',', '.') }}</p>
            </div>
            <div class="flex justify-between">
                <p class="font-semibold text-black"><strong>Kembalian :</strong></p>
                <p class="font-semibold text-black">Rp{{ number_format($order->kembalian, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button onclick="hidePrintModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Close</button>
            <button onclick="printReceipt( '{{ $order->id_order }}' )" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white px-4 py-2 rounded">Print</button>
        </div>
    </div>
</div>

<script>
    function showPrintModal() {
        document.getElementById('printModal').classList.remove('hidden');
    }

    function hidePrintModal() {
        document.getElementById('printModal').classList.add('hidden');
    }

    function printReceipt(orderId) {
    // Lakukan permintaan POST menggunakan Fetch API
    fetch(`{{ url('/receipt/') }}/${orderId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ id_order: orderId })
    })
    .then(response => response.text()) // Dapatkan konten HTML dari respons
    .then(html => {
        // Buka jendela baru dengan ukuran tertentu dan cetak struk
        const printWindow = window.open('', '_blank', 'width=800,height=600');
        printWindow.document.write(html);
        printWindow.document.close();
        printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
    })
    .catch(error => console.error('Error:', error));
    }
</script>
@endsection