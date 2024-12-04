<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Events</title>
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
      padding-bottom: 80px;
      padding-top: 60px;
      margin: 0;
    }
  </style>
</head>
<body class="flex flex-col min-h-screen">
  <!-- Content area -->
  <main class="flex-grow p-4">
    <x-customer_header />
    <!-- Event Card Content -->
    <h1 class="text-3xl font-bold mb-4 mt-5">Event News</h1>
   @if($events->isNotEmpty())
       @foreach($events as $event)
           <x-customer_event_home :event="$event"/>
       @endforeach
   @else
    <p class="text-center text-xl mt-10">No events available.</p>
   @endif
    
  </main>

  <!-- Fixed Bottom Navbar -->
  <x-customer_navbar />
  
  </script>
</body>
</html>