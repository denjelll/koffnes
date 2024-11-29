@extends('layout.admin_navbar')
@section('title')
    Edit Menu
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Edit Menu
    </div>
    <form action="{{ route('admin.update.menu') }}" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">
        <div class="mb-4">
            <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama Menu:</label>
            <input type="text" name="nama_menu" id="nama" value="{{ $menu->nama_menu }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="harga" class="block text-gray-700 text-sm font-bold mb-2">Harga:</label>
            <input type="number" name="harga" id="harga" value="{{ $menu->harga }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>{{ $menu->deskripsi }}</textarea>
        </div>
        <div class="mb-4">
            <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
            <input type="number" name="stok" id="stok" value="{{ $menu->stock }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
            <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" onchange="previewImage(event)">
            <div class="mt-2">
                <img id="featured_image_preview" class="h-64 w-128 object-cover rounded-md" src="{{ asset('menu/'.$menu->gambar) }}" alt="Featured image preview" />
            </div>
        </div>
        @if(isset($addons))
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Add-Ons:</label>
            @foreach ($addons as $addon)
                <div class="flex items-center mb-2">
                    <input type="hidden" name="id_addon[]" value="{{ $addon->id_addon }}">
                    <input type="text" name="addOns[]" value="{{ $addon->nama_addon }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                    <input type="number" name="harga_addon[]" value="{{ $addon->harga }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            @endforeach
        </div>
        @endif
        <div id="addOns" class="mb-4"></div>
        <div class="mb-4">
            <button type="button" onclick="addAddOns()" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Add-Ons</button>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update Menu
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

    function addAddOns() {
        const addOns = document.getElementById('addOns');
        addOns.innerHTML += `
            <div class="flex items-center mb-2">
                <input type="text" name="addOns[]" placeholder="Add-Ons" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                <input type="number" name="harga_addon[]" placeholder="Harga" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        `;
    }
</script>
@endsection