@extends('layout.admin_navbar')
@section('title')
    Add Menu Promo
@endsection
@section('content')
    <form action="{{route('admin.menu.promo.store')}}" method="post">
        @csrf
        <label for="id_menu">Menu :</label>
        <select name="id_menu" id="id_menu">
            @foreach ($menus as $menu)
                <option value="{{ $menu->id_menu }}">{{ $menu->nama_menu }}</option>
            @endforeach
        </select>
        <br>
        <label for="id_promo">Promo :</label>
        <select name="id_promo" id="id_promo">
            @foreach ($promos as $promo)
                <option value="{{ $promo->id_promo }}">{{ $promo->judul_promo }}</option>
            @endforeach
        </select>
        <br>
        <button type="submit">Add Menu Promo</button>
    </form>

@endsection