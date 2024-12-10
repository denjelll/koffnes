@extends('layout.admin_navbar')
@section('title')
    Edit Event
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Edit Event
    </div>
    <form action="{{ route('admin.update_event', $event->nama_event) }}" method="post" enctype="multipart/form-data" class="bg-[#f1e8d4] shadow-md rounded-lg p-6">
        @csrf
        <input type="hidden" name="id_event" value="{{$event->id_event}}">
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Event:</label>
            <input type="text" name="nama_event" id="nama" value="{{ $event->nama_event }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="tanggal" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Event:</label>
            <input type="date" name="tanggal_event" id="tanggal" value="{{ $event->tanggal_event }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="jam" class="block text-gray-700 text-sm font-bold mb-2">Jam Event:</label>
            <input type="time" name="jam_event" id="jam" value="{{ $event->jam_event }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="hadiah" class="block text-gray-700 text-sm font-bold mb-2">Hadiah:</label>
            <input type="text" name="hadiah" id="hadiah" value="{{ $event->hadiah_event }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
            <textarea name="deskripsi_event" id="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $event->deskripsi_event }}</textarea>
        </div>
        <div class="mb-4">
            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
            <input type="file" name="banner_event" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" onchange="previewImage(event)">
            <div class="mt-2">
                <img id="featured_image_preview" class="h-64 w-128 object-cover rounded-md" src="{{ asset('event/'.$event->banner_event) }}" alt="Featured image preview" />
            </div>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Event
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('featured_image_preview');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result; // Set the image source to the file's data URL
            }
            reader.readAsDataURL(file); // Read the file as a data URL
        } 
    }
</script>
@endsection