@extends('layout.admin_navbar')
@section('title')
    Transaction Recap
@endsection
@section('content')



<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Transaction Recap
    </div>

    <!-- Search and Date Range -->
    <div class="flex flex-col md:flex-row justify-center items-center gap-4 mb-6 px-4">
        <input
            type="text"
            placeholder="Search Transactions"
            id="searchInput"
            oninput="filterTransactions()"
            class="input w-full bg-white border-[#412f26] text-[#412f26] focus:outline-none focus:ring focus:ring-[#412f26]"
        />
        
    </div>

    <!-- Table -->
    <div class="overflow-x-auto mx-auto max-w-6xl shadow-md border border-gray-300 rounded-lg">
        <table class="table-auto w-full text-center">
            <thead class="bg-[#412f26] text-white">
                <tr>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Jumlah Pendapatan</th>
                    <th class="p-4">Detail</th>
                </tr>
            </thead>
            <tbody class="bg-white text-black" id="transactionTable">
                @foreach ($orders as $order)
                <tr class="border-b border-gray-300">
                    <td class="p-4">{{ date('d F Y', strtotime($order->date)) }}</td>
                    <td class="p-4">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td class="p-4">
                        <a href="{{ route('admin.transaction.date', ['date' => $order->date]) }}" class="text-[#412f26] hover:underline">View Detail</a>
                        <a href="{{ route('admin.transaction.export', ['date' => $order->date]) }}" class="text-[#412f26] hover:underline">Download Excel</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Download Button -->
    
</div>

<script>
    function filterTransactions() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#transactionTable tr');

        rows.forEach(row => {
            const date = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
            const amount = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

            if (date.includes(searchInput) || amount.includes(searchInput)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

  const burgerMenu = document.getElementById("burger-menu");
  const navLinks = document.getElementById("nav-links");

  burgerMenu.addEventListener("click", () => {
    navLinks.classList.toggle("hidden");
  });
</script>
@endsection