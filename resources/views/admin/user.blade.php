@extends('layout.admin_navbar')
@section('title')
    User Management

@endsection
@section('content')
    <h1>User Management</h1>
    <p>{{session('success')}}</p>
    <a href="{{ route('admin.add_user') }}">Add User</a>
    <table>
        <tr>
            <th>Nama User</th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $user)
        @if ($user->id_user != 99999999)
        <tr>
                <td>{{$user->nama}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->no_telepon}}</td>
                <td>{{$user->role}}</td>
                <td>
                    <a href="{{ route('admin.edit_user', $user->nama_depan) }}">Edit</a>
                    <a href="{{ route('admin.delete_user', $user->nama_depan) }}">Delete</a>
                </td>
            </tr>
        @endif
            
        @endforeach
    </table>

@endsection