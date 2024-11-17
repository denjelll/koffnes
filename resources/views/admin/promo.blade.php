@extends('layout.admin_navbar')
@section('title')
    Promo

@endsection
@section('content')
<a href="{{route('admin.promo.add')}}">Add Promo</a>
@if ($promos->count() == 0)
    <p>No promo available</p>
@endif
@foreach ($promos as $promo)
<div>
    <h1>{{ $promo->judul_promo }}</h1>
    <p>{{ $promo->harga_promo }}</p>
    <a href="{{ route('admin.promo.menu', $promo->judul_promo) }}">Daftar Menu Promosi</a>
    <a href="{{ route('admin.promo.edit', $promo->judul_promo) }}">Edit</a>
    <a href="{{ route('admin.promo.delete', $promo->judul_promo) }}">Delete</a>
</div>
@endforeach
@endsection