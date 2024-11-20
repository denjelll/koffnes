@extends('layout.admin_navbar')
@section('title')
    Edit Kategori

@endsection
@section('content')
    <form action="{{route('admin.kategori.update', $kategori->id_kategori)}}" method="post">
        @csrf
        <input type="hidden" name="id_kategori" value="{{$kategori->id_kategori}}">
        <label for="nama">Nama Kategori :</label>
        <input type="text" name="nama_kategori" id="nama_kategori" value="{{$kategori->nama_kategori}}">
        <br>
        <table>
            <tr>
                <th>Pilih</th>
                <th>Gambar menu</th>
                <th>Nama Menu</th>
            </tr>
        @foreach ($menus as $menu)
            <tr>
                <td><input type="checkbox" name="menu[]" value="{{$menu->id_menu}}" 
                @if (in_array($menu->id_menu, $isi_kategoris->pluck('id_menu')->toArray())) checked @endif> </td>
                <td><img src="{{ asset('menu/' . $menu->gambar) }}" alt=""></td>
                <td><p>{{ $menu->nama_menu }}</p></td>
            </tr>
        @endforeach
        </table>
        <button type="submit">Edit Kategori</button>
    </form>
@endsection