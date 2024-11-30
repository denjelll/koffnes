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
            <p class="text-gray-700"><strong>Tanggal Transaksi:</strong> {{ date('d F Y', strtotime($order->waktu_transaksi)) }}</p>
            <p class="text-gray-700"><strong>ID Order:</strong> {{ $order->id_order }}</p>
            <p class="text-gray-700"><strong>Nama Customer:</strong> {{ $order->customer }}</p>
            <p class="text-gray-700"><strong>Nomor Meja:</strong> {{ $order->meja }}</p>
            <p class="text-gray-700"><strong>Tipe Order:</strong> {{ $order->tipe_order }}</p>
            <p class="text-gray-700"><strong>Kasir:</strong> {{ $order->cashier->nama }}</p>
        </div>
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-center">
                <thead class="bg-[#412f26] text-white">
                    <tr>
                        <th class="p-4">Nama Menu</th>
                        <th class="p-4">Kuantitas</th>
                        <th class="p-4">Harga</th>
                        <th class="p-4">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-[#f1e8d4] text-black">
                    @foreach ($order->detailOrders as $detail)
                        <tr class="border-b border-gray-300">
                            <td class="p-4">{{ $detail->menu->nama_menu }}</td>
                            <td class="p-4">{{ $detail->kuantitas }}</td>
                            <td class="p-4">Rp{{ number_format($detail->harga_menu, 0, ',', '.') }}</td>
                            <td class="p-4">Rp{{ number_format($detail->harga_menu * $detail->kuantitas, 0, ',', '.') }}</td>
                        </tr>
                        @if ($detail->detailAddon != null)
                            @foreach ($detail->detailAddon as $addon)
                                <tr class="border-b border-gray-300 bg-white text-[#412f26]">
                                    <td class="p-4">{{ $addon->addon->nama_addon }}</td>
                                    <td class="p-4">{{ $addon->kuantitas }}</td>
                                    <td class="p-4">Rp{{ number_format($addon->harga, 0, ',', '.') }}</td>
                                    <td class="p-4">Rp{{ number_format($addon->harga * $addon->kuantitas, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            <p class="text-xl font-semibold text-gray-700"><strong>Total Harga:</strong> Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
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
                <p class="text-gray-700"><strong>Tanggal Transaksi:</strong> {{ date('d F Y', strtotime($order->waktu_transaksi)) }}</p>
                <p class="text-gray-700"><strong>ID Order:</strong> {{ $order->id_order }}</p>
                <p class="text-gray-700"><strong>Nama Customer:</strong> {{ $order->customer }}</p>
                <p class="text-gray-700"><strong>Nomor Meja:</strong> {{ $order->meja }}</p>
                <p class="text-gray-700"><strong>Tipe Order:</strong> {{ $order->tipe_order }}</p>
                <p class="text-gray-700"><strong>Kasir:</strong> {{ $order->cashier->nama }}</p>
            </div>
            <div class="overflow-x-auto">
                <div class="grid grid-cols-4 gap-4">
                    <div class="font-bold p-4 text-black">Nama Menu</div>
                    <div class="font-bold p-4 text-black">Kuantitas</div>
                    <div class="font-bold p-4 text-black">Harga</div>
                    <div class="font-bold p-4 text-black">Subtotal</div>
                    @foreach ($order->detailOrders as $detail)
                        <div class="border-b border-gray-300 p-4"><strong>{{ $detail->menu->nama_menu }}</strong></div>
                        <div class="border-b border-gray-300 p-4"><strong>{{ $detail->kuantitas }}</strong></div>
                        <div class="border-b border-gray-300 p-4"><strong>Rp{{ number_format($detail->harga_menu, 0, ',', '.') }}</strong></div>
                        <div class="border-b border-gray-300 p-4"><strong>Rp{{ number_format($detail->harga_menu * $detail->kuantitas, 0, ',', '.') }}</strong></div>
                        @if ($detail->detailAddon != null)
                            @foreach ($detail->detailAddon as $addon)
                                <div class="border-b border-gray-300 p-4 bg-white text-[#412f26]">+ {{ $addon->addon->nama_addon }}</div>
                                <div class="border-b border-gray-300 p-4 bg-white text-[#412f26]">{{ $addon->kuantitas }}</div>
                                <div class="border-b border-gray-300 p-4 bg-white text-[#412f26]">Rp{{ number_format($addon->harga, 0, ',', '.') }}</div>
                                <div class="border-b border-gray-300 p-4 bg-white text-[#412f26]">Rp{{ number_format($addon->harga * $addon->kuantitas, 0, ',', '.') }}</div>
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="mt-6 flex justify-between">
                <p class="text-xl font-bold text-black col-span-3 text-right">Total Harga:</p>
                <p class="text-xl font-bold text-black">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button onclick="hidePrintModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Close</button>
            <button onclick="printContent()" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white px-4 py-2 rounded">Print</button>
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

    function printContent() {
        const printContent = document.getElementById('printContent').innerHTML;
        const originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
</script>
@endsection