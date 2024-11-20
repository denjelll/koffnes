@extends('layout.admin_navbar')
@section('title')
    Add Event

@endsection
@section('content')
    <form action="{{ route('admin.store_event') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="nama">Nama Event :</label>
        <input type="text" name="nama_event" id="nama" required>
        <br>
        <label for="tanggal">Tanggal Event :</label>
        <input type="date" name="tanggal_event" id="tanggal" required>
        <br>
        <label for="jam">Jam Event :</label>
        <input type="time" name="jam_event" id="jam" required>
        <br>
        <label for="hadiah">Hadiah :</label>
        <input type="text" name="hadiah" id="hadiah" required>
        <br>
        <label for="deskripsi">Deskripsi :</label>
        <textarea name="deskripsi_event" id="deskripsi" required></textarea>
        <br>
        <label for="gambar">Banner Event :</label>
        <input type="file" name="banner_event" id="gambar" required>
        <br>
        <button type="submit">Add Event</button>
    </form>

@endsection