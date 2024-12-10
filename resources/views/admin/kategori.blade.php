@extends('layout.admin_navbar')
@section('title')
    Kategori Management
@endsection
@section('content')


<div class="px-8 py-6 pb-[4rem] pt-[5rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Kategori Management
    </div>

    <!-- Search and Filter Section -->
    <div class="flex items-center gap-4 mb-8">
        <!-- Add Kategori Button -->
        <a
            class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] cursor-pointer whitespace-nowrap"
            style="background-color: #412f26" href="{{ route('admin.kategori.add') }}"
        >
            Add Kategori
        </a>
    </div>

    @if ($kategoris->count() == 0)
        <p>No kategori available</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-3 gap-6">
            @foreach ($kategoris as $kategori)
                <div class="card bg-[#f1e8d4] shadow-lg rounded-lg overflow-hidden flex flex-row items-center gap-4 p-4">
                    <!-- Text Section -->
                    <div class="flex-grow">
                        <h2 class="font-bold text-lg text-[#412f26]">{{ $kategori->nama_kategori }}</h2>
                    </div>
                    <!-- Control Section -->
                    <div class="flex flex-row items-center space-x-2">
                        <!-- Edit Button -->
                        <a href="{{ route('admin.kategori.edit', $kategori->nama_kategori) }}"
                            class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f] px-4 py-2 rounded-md text-sm"
                        >
                            Edit
                        </a>
                        <!-- Delete Button -->
                        <button onclick="showDeleteModal('{{ route('admin.kategori.delete', $kategori->nama_kategori) }}')" class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f] px-4 py-2 rounded-md text-sm">
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
        <p class="mb-4">Apakah Anda yakin ingin menghapus kategori ini?</p>
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
</script>

@endsection