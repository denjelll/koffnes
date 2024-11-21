@extends ('layout.admin_navbar')
@section('title')
    Add Promo

@endsection
@section('content')
    <form action="{{route('admin.promo.store')}}" method="post">
        @csrf
        <label for="judul_promo">Judul Promo :</label>
        <input type="text" name="judul_promo" id="judul_promo">
        <br>
        <label for="product">Product :</label>
        <select name="product" id="product">
            @foreach ($menus as $menu)
                
                <option value="{{ $menu->id_menu }}">{{ $menu->nama_menu }}</option>
            @endforeach
        </select>
        <br>
        <label for="harga_promo">Harga Promo :</label>
        <input type="number" name="harga_promo" id="harga_promo">
        <br>
        <label for="hari">Hari Promo :</label>
        <br>
        <input type="radio" name="hari" id="hari" value="Monday">Monday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Tuesday">Tuesday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Wednesday">Wednesday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Thursday">Thursday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Friday">Friday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Saturday">Saturday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="Sunday">Sunday</input>
        <br>
        <input type="radio" name="hari" id="hari" value="AllDay">Setiap hari</input>
        <br>
        <label for="waktu">Setiap Jam :</label>
        <input type="time" name="waktu_mulai" id="waktu_mulai"> - <input type="time" name="waktu_berakhir" id="waktu_berakhir">
        <br>
        <button type="submit">Add Promo</button>
    </form>
@endsection