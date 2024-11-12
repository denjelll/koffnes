@extends ('layout.admin_navbar')
@section('title')
    Menu Management
@endsection
@section('content')
<a href="{{ route('admin.menu.add')  }}">Add Menu</a>
@if ($menus->count() == 0)
    <p>No menu available</p>

@endif
@foreach ($menus as $menu)


<div>
    <img src="{{ asset('menu/'.$menu->gambar) }}" alt="">
    <h1>{{ $menu->nama_menu }}</h1>
    <p>Rp. {{ $menu->harga }}</p>
    <a href="{{ route('admin.menu.edit', $menu->id_menu) }}">Edit</a>
    <a href="{{ route('admin.menu.delete', $menu->id_menu) }}">Delete</a>
</div>
@endforeach
@endsection