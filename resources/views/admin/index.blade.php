@extends('layout.admin_navbar')
@section('title')
    Admin Panel
@endsection
@section('content')
    <h1>Welcome to Admin Panel</h1>
    <p>This is the admin panel</p>
    <!-- welcome, nama user -->
    <p>Welcome, {{ session('role')}}</p>
@endsection
