@extends('layout.admin_navbar')
@section('title')
    Edit Promo

@endsection
@section('content')
    <form action="{{route('admin.promo.update', $promo->id_promo)}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_promo" value="{{$promo->id_promo}}">
        <label for="judul_promo">Judul Promo :</label>
        <input type="text" name="judul_promo" id="judul_promo" value="{{$promo->judul_promo}}">
        <br>
        <label for="harga_promo">Harga Promo :</label>
        <input type="number" name="harga_promo" id="harga_promo" value="{{$promo->harga_promo}}">
        <br>
        <label for="hari">Hari Promo :</label>
        <br>
        <input type="radio" name="hari" id="hari" value="Monday" {{$promo->hari == 'Monday' ? 'checked' : ''}}>Monday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Tuesday" {{$promo->hari == 'Tuesday' ? 'checked' : ''}}>Tuesday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Wednesday" {{$promo->hari == 'Wednesday' ? 'checked' : ''}}>Wednesday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Thursday" {{$promo->hari == 'Thursday' ? 'checked' : ''}}>Thursday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Friday" {{$promo->hari == 'Friday' ? 'checked' : ''}}>Friday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Saturday" {{$promo->hari == 'Saturday' ? 'checked' : ''}}>Saturday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Sunday" {{$promo->hari == 'Sunday' ? 'checked' : ''}}>Sunday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="AllDay" {{$promo->hari == 'AllDay' ? 'checked' : ''}}>Setiap hari</input>
        <br>
        <label for="waktu">Setiap Jam :</label>
        <input type="time" name="waktu_mulai" id="waktu_mulai" value="{{$promo->waktu_mulai}}"> - <input type="time" name="waktu_berakhir" id="waktu_berakhir" value="{{$promo->waktu_berakhir}}">
        <br>
        <button type="submit">Edit Promo</button>
    </form>
@endsection