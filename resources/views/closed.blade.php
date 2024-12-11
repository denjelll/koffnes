<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('storage/asset/gambar/icon.png') }}">
    @vite('resources/css/app.css')
    <title>Closed</title>
    <style>
        html {
            overflow-y: scroll;
            scrollbar-width: none; /* Untuk Firefox */
        }

        html::-webkit-scrollbar {
            display: none; /* Untuk Chrome, Safari, dan Edge */
        }

        body {
      background-image: url("{{ asset('storage/asset/gambar/motif.png') }}");
      background-repeat: repeat;
      background-position: top left;
      background-size: 400px 400px;
      margin: 0;
        }

    </style>
</head>
<body class="flex flex-col min-h-screen items-center justify-center text-center">
    <x-customer_header />
    <div class="flex flex-col items-center">
        <img src="{{ asset('storage/asset/gambar/close.gif') }}" alt="Animated GIF" class="mb-4" style="width: 60%; max-width: 300px;">
        <h1 class="font-semibold" style="font-size: 24px">Yahh Masih Tutup 🥲<br>Tunggu buka yah</h1>
    </div>
    <!-- Fixed Bottom Navbar -->
</body>
</html>
