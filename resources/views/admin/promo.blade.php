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
    <p>{{ $promo->menu->nama_menu }}</p>
    <p>{{ $promo->harga_promo }}</p>
    <p>{{ $promo->tanggal_m }} - {{$promo->tanggal_b}}</p>
    
    <p>{{ $promo->waktu_mulai }} - {{ $promo->waktu_berakhir }}</p>
    <a href="{{ route('admin.promo.edit', $promo->judul_promo) }}">Edit</a>
    <a href="{{ route('admin.promo.delete', $promo->judul_promo) }}">Delete</a>
</div>
@endforeach
@endsection