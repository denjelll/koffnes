@extends('layout.admin_navbar')
@section('title')
    Add Kategori
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Add Kategori
    </div>
    <form action="{{ route('admin.kategori.store') }}" method="post" class="shadow-md rounded-lg p-6 bg-[#f1e8d4]">
        @csrf
        <div class="mb-4">
            <label for="nama_kategori" class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori:</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Menu:</label>
            <table class="min-w-full bg-white" >
                <thead>
                    <tr>
                        <th class="py-2">Pilih</th>
                        <th class="py-2">Gambar Menu</th>
                        <th class="py-2">Nama Menu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <td class="py-2 text-center">
                                <input type="checkbox" name="menu[]" value="{{ $menu->id_menu }}" class="form-checkbox h-5 w-5 text-[#412f26]">
                            </td>
                            <td class="py-2 text-center">
                                <div class="flex justify-center">
                                    <img src="{{ asset('menu/' . $menu->gambar) }}" alt="{{ $menu->nama_menu }}" class="h-16 w-16 object-cover rounded">
                                </div>
                            </td>
                            <td class="py-2 text-center">
                                <p class="text-gray-700">{{ $menu->nama_menu }}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add Kategori
            </button>
        </div>
    </form>
</div>
@endsection