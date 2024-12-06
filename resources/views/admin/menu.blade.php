@extends ('layout.admin_navbar')
@section('title')
    Menu Management
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Menu Management
    </div>
    <div class="flex flex-col sm:flex-row items-center gap-4 mb-8">
        <!-- Add Menu Button -->
        <a
            class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] cursor-pointer whitespace-nowrap"
            style="background-color: #412f26" href="{{ route('admin.menu.add')  }}"
        >
            Add Menu
        </a>

        <input
            type="text"
            placeholder="Search Menu"
            id="searchInput"
            oninput="filterMenu()"
            class="input w-full sm:w-auto bg-white border-[#412f26] text-[#412f26] focus:outline-none focus:ring focus:ring-[#412f26]"
        />
        <!-- Category Filter -->
        <select
            id="categoryFilter"
            onchange="filterMenu()"
            class="select w-full sm:w-auto bg-white border-[#412f26] text-[#412f26] focus:outline-none focus:ring focus:ring-[#412f26]"
        >
            <option value="All">All Categories</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
            @endforeach
        </select>
    </div>

    @if ($menus->count() == 0)
        <p>No menu available</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($menus as $menu)
                <div class="card w-60 bg-[#f1e8d4] shadow-md rounded-lg overflow-hidden" data-category="{{ $menu->isi_kategori->pluck('id_kategori')->implode(',') }}">
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <img src="{{ asset('menu/'.$menu->gambar) }}" alt="Menu Image" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-bold text-[#412f26]">{{ $menu->nama_menu }}</h3>
                        <p class="text-black font-medium">Rp. {{ $menu->harga }}</p>
                        <p class="text-black font-medium">Stok : {{ $menu->stock }}</p>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="{{ route('admin.menu.edit', $menu->nama_menu) }}"
                            class="btn bg-[#412f26] text-white w-full rounded-md hover:bg-[#593c2e]"
                            style="background-color: #412f26"
                        >
                            Edit
                        </a>
                    </div>
                    <div class="p-4 pt-0">
                        <button onclick="showDeleteModal('{{ route('admin.menu.delete', $menu->id_menu) }}')" class="btn bg-danger text-white w-full rounded-md hover:bg-[#593c2e]" style="background-color: #412f26">
                            Delete
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
        <p class="mb-4">Apakah Anda yakin ingin menghapus menu ini?</p>
        <div class="flex justify-end">
            <button onclick="hideDeleteModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
            <a id="deleteLink" href="#" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</a>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(deleteUrl) {
        document.getElementById('deleteLink').href = deleteUrl;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    function filterMenu() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        const categoryFilter = document.getElementById('categoryFilter').value;
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const categories = card.getAttribute('data-category').split(',');

            if ((title.includes(searchInput) || searchInput === '') && (categories.includes(categoryFilter) || categoryFilter === 'All')) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
@endsection