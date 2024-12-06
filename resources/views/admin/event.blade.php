@extends('layout.admin_navbar')
@section('title')
    Event Management
@endsection
@section('content')

<div class="px-8 py-6 pb-[4rem]">
    <div class="flex items-center justify-between mb-6">
        <div class="text-2xl font-semibold text-[#412f26]">
            Event Management
        </div>
        <!-- Add Event Button -->
        <a
            for="add-event-modal"
            class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] cursor-pointer" href="{{ route('admin.add_event') }}"
            
        >
            Add Event
        </a>
    </div>

    <!-- Divider Line -->
    <hr class="border-t border-[#b18968] mb-8" />

    @if (count($events) == 0)
        <p>No data</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 gap-6">
            @foreach ($events as $event)
                <div class="card bg-white shadow-lg relative overflow-hidden">
                    <!-- Image as background -->
                    <figure class="relative w-full h-72">
                        <img src="{{ asset('event/'.$event->banner_event) }}" alt="{{ $event->nama_event }}" class="absolute inset-0 w-full h-full object-cover" />
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white/90 via-white/60 to-transparent p-6 flex flex-col justify-end">
                            <!-- Text Content and Button Row -->
                            <div class="flex items-center justify-between w-full">
                                <!-- Text Content -->
                                <div class="text-left">
                                    <h2 class="text-[#412f26] font-bold text-xl">{{ $event->nama_event }}</h2>
                                    <p class="text-[#412f26] text-sm mt-1">{{ Str::limit($event->deskripsi_event, 40) }}</p>
                                </div>
                                <!-- Button -->
                                <div class="flex flex-row items-center space-x-2">
                                    <a href="{{ route('admin.edit_event', $event->nama_event) }}" class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f] px-4 py-2 rounded-md text-sm">Edit</a>
                                    <button onclick="showDeleteModal('{{ route('admin.delete_event', $event->nama_event) }}')" class="btn bg-[#412f26] text-white hover:bg-[#5a3e2f] px-4 py-2 rounded-md text-sm">Delete</button>
                                </div>
                            </div>
                        </div>
                    </figure>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
        <p class="mb-4">Apakah Anda yakin ingin menghapus event ini?</p>
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