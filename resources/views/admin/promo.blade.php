@extends('layout.admin_navbar')
@section('title')
    Promo

@endsection
@section('content')
<a href="{{route('admin.promo.add')}}">Add Promo</a>
@if ($menus->count() == 0)
    <p>No promo available</p>
@endif
@foreach ($menus as $menu)
<div>
    <h1>{{ $menu->promo->judul_promo }}</h1>
    <img src="{{ asset('menu/' . $menu->gambar) }}" alt="">
    <p>{{ $menu->nama_menu }}</p>
    <p>{{ $menu->promo->harga_promo }}</p>
    <p>Setiap hari : {{ $menu->promo->hari }}</p>
    
    <p>{{ $menu->promo->waktu_mulai }} - {{ $menu->promo->waktu_berakhir }}</p>
    <a href="{{ route('admin.promo.edit', $menu->promo->judul_promo) }}">Edit</a>
    <a href="{{ route('admin.promo.delete', $menu->promo->judul_promo) }}">Delete</a>
</div>
@endforeach
@endsection