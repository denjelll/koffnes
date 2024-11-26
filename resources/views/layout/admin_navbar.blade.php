<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
</head>
<body>
    @if (session('role')!='Admin' || session('role')==null)
        <script>window.location = "/login";</script>
    @endif
   
    <nav>
        <a href="{{ route('admin.index') }}">Home</a>
        <a href="{{ route('admin.logout') }}">Logout</a>
        <a href="{{ route('admin.menu') }}">Menu Management</a>
        <a href="{{ route('admin.kategori') }}">Kategori</a>
        <a href="{{ route('admin.promo') }}">Promotion</a>
        <a href="{{ route('admin.user') }}">User Management</a>
        <a href="{{ route('admin.event') }}">Event Management</a>
        <a href="{{ route('admin.koffnesstatus') }}">Status Koffnes</a>
    </nav>
    @yield('content')
</body>
</html>