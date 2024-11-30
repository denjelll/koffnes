@extends('layout.admin_navbar')
@section('title')
    Add Promo
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Add Promo
    </div>
    <form action="{{ route('admin.promo.store') }}" method="post" class=" shadow-md rounded-lg p-6" style="background-color: #fff2e2">
        @csrf
        <div class="mb-4">
            <label for="judul_promo" class="block text-gray-700 text-sm font-bold mb-2">Judul Promo:</label>
            <input type="text" name="judul_promo" id="judul_promo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="product" class="block text-gray-700 text-sm font-bold mb-2">Product:</label>
            <select name="product" id="product" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                @foreach ($menus as $menu)
                    <option value="{{ $menu->id_menu }}">{{ $menu->nama_menu }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="harga_promo" class="block text-gray-700 text-sm font-bold mb-2">Harga Promo:</label>
            <input type="number" name="harga_promo" id="harga_promo" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="hari" class="block text-gray-700 text-sm font-bold mb-2">Hari Promo:</label>
            <div class="flex flex-wrap gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Monday" class="form-radio text-[#412f26]" required>
                    <span class="ml-2">Monday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Tuesday" class="form-radio text-[#412f26]" required>
                    <span class="ml-2">Tuesday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Wednesday" class="form-radio text-[#412f26]" required>
                    <span class="ml-2">Wednesday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Thursday" class="form-radio text-[#412f26]" required>
                    <span class="ml-2">Thursday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Friday" class="form-radio text-[#412f26]" required>
                    <span class="ml-2">Friday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Saturday" class="form-radio text-[#412f26]" required>
                    <span class="ml-2">Saturday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Sunday" class="form-radio text-[#412f26]" required>
                    <span class="ml-2">Sunday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="AllDay" class="form-radio text-[#412f26]" required>
                    <span class="ml-2">Setiap hari</span>
                </label>
            </div>
        </div>
        <div class="mb-4">
            <label for="waktu_mulai" class="block text-gray-700 text-sm font-bold mb-2">Waktu Mulai:</label>
            <input type="time" name="waktu_mulai" id="waktu_mulai" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="waktu_berakhir" class="block text-gray-700 text-sm font-bold mb-2">Waktu Berakhir:</label>
            <input type="time" name="waktu_berakhir" id="waktu_berakhir" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add Promo
            </button>
        </div>
    </form>
</div>
@endsection