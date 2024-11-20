@extends('layout.admin_navbar')
@section('title')
    Edit User

@endsection
@section('content')
    <form action="{{route('admin.update_user', $user->id_user)}}" method="post">
        @csrf
        <p>{{session('error')}}</p>
        <input type="hidden" name="id_user" value="{{$user->id_user}}">
        <label for="nama">Nama Depan :</label>
        <input type="text" name="nama_depan" id="nama" value="{{$user->nama_depan}}">
        <br>
        <label for="nama">Nama Belakang :</label>
        <input type="text" name="nama_belakang" id="nama" value="{{$user->nama_belakang}}">
        <br>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" value="{{$user->email}}">
        <br>
        <label for="no_telepon">No Telepon :</label>
        <input type="text" name="no_telepon" id="no_telepon" value="{{$user->no_telepon}}">
        <br>
        <label for="role">Role :</label>
        <select name="role" id="role">
            <option value="Admin" @if($user->role == 'Admin') selected @endif>Admin</option>
            <option value="Kasir" @if($user->role == 'Kasir') selected @endif>Kasir</option>
        </select>
        <br>
        <button type="button" onclick="editPassword()">Edit Password</button>
        <div id="password" style="display: none;">
            <label for="password">New Password :</label>
            <input type="password" name="password" id="password">
            <br>
            <label for="password_confirmation">Confirm Password :</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            <br>
        </div>
        <br>
        <button type="submit">Edit User</button>
    </form>
    <script>
        function editPassword() {
            var x = document.getElementById("password");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection