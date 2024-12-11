@extends('layout.admin_navbar')
@section('title')
    Add Event
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Add Event
    </div>
    <form action="{{ route('admin.store_event') }}" method="post" enctype="multipart/form-data" class="bg-[#f1e8d4] shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="nama_event" class="block text-gray-700 text-sm font-bold mb-2">Nama Event:</label>
            <input type="text" name="nama_event" id="nama_event" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="tanggal_event" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Event:</label>
            <input type="date" name="tanggal_event" id="tanggal_event" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="jam_event" class="block text-gray-700 text-sm font-bold mb-2">Jam Event:</label>
            <input type="time" name="jam_event" id="jam_event" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="hadiah" class="block text-gray-700 text-sm font-bold mb-2">Hadiah:</label>
            <input type="text" name="hadiah" id="hadiah" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="deskripsi_event" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
            <textarea name="deskripsi_event" id="deskripsi_event" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
        </div>
        <div class="mb-4">
            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
            <input type="file" name="banner_event" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add Event
            </button>
        </div>
    </form>
</div>
@endsection