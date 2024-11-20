@extends('layout.admin_navbar')
@section('title')
    Add Kategori

@endsection
@section('content')
    <form action="{{route('admin.kategori.store')}}" method="post">
        @csrf
        <label for="nama">Nama Kategori :</label>
        <input type="text" name="nama_kategori" id="nama">
        <br>
        <table>
            <tr>
                <th>Pilih</th>
                <th>Gambar menu</th>
                <th>Nama Menu</th>
            </tr>
        @foreach ($menus as $menu)
            <tr>
                <td><input type="checkbox" name="menu[]" value="{{$menu->id_menu}}"> </td>
                <td><img src="{{ asset('menu/' . $menu->gambar) }}" alt=""></td>
            
            <td><p>{{ $menu->nama_menu }}</p></td>
        </tr>
        @endforeach
        </table>
        
        <button type="submit">Add Kategori</button>
    </form>

@endsection