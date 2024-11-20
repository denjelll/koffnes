@extends('layout.admin_navbar')
@section('title')
    Add User
@endsection
@section('content')
    <form action="{{route('admin.store_user')}}" method="post">
        @csrf
        <label for="nama">Nama Depan :</label>
        <input type="text" name="nama_depan" id="nama" required>
        <br>
        <label for="nama">Nama Belakang :</label>
        <input type="text" name="nama_belakang" id="nama" required>
        <br>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password :</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="password_confirmation">Confirm Password :</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <br>
        <label for="no_telepon">No Telepon :</label>
        <input type="text" name="no_telepon" id="no_telepon" required>
        <br>
        <label for="role">Role :</label>
        <select name="role" id="role" required>
            <option value="Admin">Admin</option>
            <option value="Kasir">Kasir</option>
        </select>
        <br>
        <button type="submit">Add User</button>
    </form>
@endsection
