@extends('layout.admin_navbar')
@section('title')
    Edit Promo
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Edit Promo
    </div>
    <form action="{{route('admin.promo.update', $promo->id_promo)}}" method="post" enctype="multipart/form-data" class="bg-[#f1e8d4] shadow-md rounded-lg p-6">
        @csrf
        <input type="hidden" name="id_promo" value="{{$promo->id_promo}}">
        <div class="mb-4">
            <label for="judul_promo" class="block text-gray-700 text-sm font-bold mb-2">Judul Promo:</label>
            <input type="text" name="judul_promo" id="judul_promo" value="{{$promo->judul_promo}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="harga_promo" class="block text-gray-700 text-sm font-bold mb-2">Harga Promo:</label>
            <input type="number" name="harga_promo" id="harga_promo" value="{{$promo->harga_promo}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="hari" class="block text-gray-700 text-sm font-bold mb-2">Hari Promo:</label>
            <div class="flex flex-wrap gap-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Monday" class="form-radio text-[#412f26]" {{$promo->hari == 'Monday' ? 'checked' : ''}}>
                    <span class="ml-2">Monday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Tuesday" class="form-radio text-[#412f26]" {{$promo->hari == 'Tuesday' ? 'checked' : ''}}>
                    <span class="ml-2">Tuesday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Wednesday" class="form-radio text-[#412f26]" {{$promo->hari == 'Wednesday' ? 'checked' : ''}}>
                    <span class="ml-2">Wednesday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Thursday" class="form-radio text-[#412f26]" {{$promo->hari == 'Thursday' ? 'checked' : ''}}>
                    <span class="ml-2">Thursday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Friday" class="form-radio text-[#412f26]" {{$promo->hari == 'Friday' ? 'checked' : ''}}>
                    <span class="ml-2">Friday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Saturday" class="form-radio text-[#412f26]" {{$promo->hari == 'Saturday' ? 'checked' : ''}}>
                    <span class="ml-2">Saturday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="Sunday" class="form-radio text-[#412f26]" {{$promo->hari == 'Sunday' ? 'checked' : ''}}>
                    <span class="ml-2">Sunday</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="hari" value="AllDay" class="form-radio text-[#412f26]" {{$promo->hari == 'AllDay' ? 'checked' : ''}}>
                    <span class="ml-2">Setiap hari</span>
                </label>
            </div>
        </div>
        <div class="mb-4">
            <label for="waktu_mulai" class="block text-gray-700 text-sm font-bold mb-2">Waktu Mulai:</label>
            <input type="time" name="waktu_mulai" id="waktu_mulai" value="{{$promo->waktu_mulai}}" class="shadow appearance-none border rounded w-full py
        <div class="mb-4">
            <label for="waktu_berakhir" class="block text-gray-700 text-sm font-bold mb-2">Waktu Berakhir:</label>
            <input type="time" name="waktu_berakhir" id="waktu_berakhir" value="{{$promo->waktu_berakhir}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2e] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Edit Promo</button>
        </div>
    </form>
</div>
@endsection