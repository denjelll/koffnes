<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cashier Page</title>
</head>
<body>
    <a href="{{ route('cashier.logout') }}">Logout</a>
    <h1>Welcome, {{ session('nama') }}</h1>
</body>
</html>