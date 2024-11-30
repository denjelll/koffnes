@extends('layout.admin_navbar')
@section('title')
    Add Menu
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Add Menu
    </div>
    <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-4">
            <label for="nama_menu" class="block text-gray-700 text-sm font-bold mb-2">Nama Menu:</label>
            <input type="text" name="nama_menu" id="nama_menu" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="harga" class="block text-gray-700 text-sm font-bold mb-2">Harga:</label>
            <input type="number" name="harga" id="harga" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="deskripsi" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi:</label>
            <textarea name="deskripsi" id="deskripsi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
        </div>
        <div class="mb-4">
            <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
            <input type="number" name="stok" id="stok" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="gambar" class="block text-gray-700 text-sm font-bold mb-2">Gambar:</label>
            <input type="file" name="gambar" id="gambar" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <button type="button" onclick="togglePromo()" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Promo</button>
        </div>
        <div id="promo-container" style="display: none;">
            <div class="mb-4">
                <label for="judul_promo" class="block text-gray-700 text-sm font-bold mb-2">Judul Promo:</label>
                <input type="text" name="judul_promo" id="judul_promo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="harga_promo" class="block text-gray-700 text-sm font-bold mb-2">Harga Promo:</label>
                <input type="number" name="harga_promo" id="harga_promo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="hari" class="block text-gray-700 text-sm font-bold mb-2">Hari Promo:</label>
                <div class="flex flex-wrap gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="hari" value="Monday" class="form-radio text-[#412f26]">
                        <span class="ml-2">Monday</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="hari" value="Tuesday" class="form-radio text-[#412f26]">
                        <span class="ml-2">Tuesday</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="hari" value="Wednesday" class="form-radio text-[#412f26]">
                        <span class="ml-2">Wednesday</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="hari" value="Thursday" class="form-radio text-[#412f26]">
                        <span class="ml-2">Thursday</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="hari" value="Friday" class="form-radio text-[#412f26]">
                        <span class="ml-2">Friday</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="hari" value="Saturday" class="form-radio text-[#412f26]">
                        <span class="ml-2">Saturday</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="hari" value="Sunday" class="form-radio text-[#412f26]">
                        <span class="ml-2">Sunday</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="hari" value="AllDay" class="form-radio text-[#412f26]">
                        <span class="ml-2">Setiap hari</span>
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label for="waktu_mulai" class="block text-gray-700 text-sm font-bold mb-2">Waktu Mulai:</label>
                <input type="time" name="waktu_mulai" id="waktu_mulai" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label for="waktu_berakhir" class="block text-gray-700 text-sm font-bold mb-2">Waktu Berakhir:</label>
                <input type="time" name="waktu_berakhir" id="waktu_berakhir" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
        </div>
        <div class="mb-4">
            <button type="button" onclick="addAddOns()" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Add Add-Ons</button>
        </div>
        <div id="addOns" class="mb-4">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add Menu
            </button>
        </div>
    </form>
</div>

<script>
    function togglePromo() {
        const promoContainer = document.getElementById('promo-container');
        promoContainer.style.display = promoContainer.style.display === 'none' ? 'block' : 'none';
    }

    function addAddOns() {
        const addOns = document.getElementById('addOns');
        addOns.innerHTML += `
            <div class="flex items-center mb-2">
                <input type="text" name="addOns[]" placeholder="Add-Ons" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2">
                <input type="number" name="harga_addon[]" placeholder="Harga" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <button type="button" onclick="removeAddOn(this)" class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">X</button>
            </div>
        `;
    }
    function removeAddOn(button) {
        button.parentElement.remove();
    }
</script>
@endsection