@extends('layout.admin_navbar')
@section('title')
Edit Event
@endsection
@section('content')
    <form action="{{ route('admin.update_event', $event->nama_event) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_event" value="{{$event->id_event}}">
        <label for="nama">Nama Event :</label>
        <input type="text" name="nama_event" id="nama" value="{{ $event->nama_event }}" required>
        <br>
        <label for="tanggal">Tanggal Event :</label>
        <input type="date" name="tanggal_event" id="tanggal" value="{{ $event->tanggal_event }}" required>
        <br>
        <label for="jam">Jam Event :</label>
        <input type="time" name="jam_event" id="jam" value="{{ $event->jam_event }}" required>
        <br>
        <label for="hadiah">Hadiah :</label>
        <input type="text" name="hadiah" id="hadiah" value="{{ $event->hadiah_event }}" required>
        <br>
        <label for="deskripsi">Deskripsi :</label>
        <textarea name="deskripsi_event" id="deskripsi" required>{{ $event->deskripsi_event }}</textarea>
        <br>
        <label for="gambar">Banner Event :</label>
        <input type="file" id="gambar" name="banner_event" accept="image/*" onchange="previewImage(event)">
    <div>
        <img id="featured_image_preview" class="h-64 w-128 object-cover rounded-md" src="{{asset('event/'.$event->banner_event)}}" alt="Featured image preview" />
    </div>
        <button type="submit">Edit Event</button>
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
