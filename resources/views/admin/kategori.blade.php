@extends('layout.admin_navbar')
@section('title')
    Kategori
@endsection
@section('content')
    <a href="{{route('admin.kategori.add')}}">Add Kategori</a>
    <table>
        <tr>
            <th>Nama Kategori</th>
            <th>Jumlah Menu</th>
            <th>Action</th>
        </tr>
        @if ($kategoris->count() == 0)
        <tr>
            <td colspan="4">No kategori available</td>
        </tr>
        @endif
        @foreach ($kategoris as $kategori)
        <tr>
            <td>{{ $kategori->nama_kategori }}</td>
            <td>{{ $isi_kategoris }}</td>
            <td>
                <a href="{{ route('admin.kategori.edit', $kategori->nama_kategori) }}">Edit</a>
                <a href="{{ route('admin.kategori.delete', $kategori->nama_kategori) }}">Delete</a>
            </td>
        </tr>
        @endforeach

    </table>
    

@endsection