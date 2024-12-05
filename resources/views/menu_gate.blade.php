<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="{{ asset('storage/asset/gambar/icon.png') }}">
  <title>Menu</title>
  @vite('resources/css/app.css')
  <style>
    .slide {
        display: none;
    }
    .slide.active {
        display: block;
    }

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
        <img src="{{ asset('storage/asset/gambar/scanqr.gif') }}" alt="Animated GIF" class="mb-4" style="width: 60%; max-width: 300px;">
        <h2 class="text-lg font-semibold">Silahkan Scan QR Code di meja untuk memesan!</h2>
    </div>
    <!-- Fixed Bottom Navbar -->
    <x-customer_navbar />
</body>
</html>