<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      /* Force background color to white for body and .bg-base-100 */
      body,
      .bg-base-100 {
        background-color: white !important;
      }
      body {
        background-image: url("{{asset('asset/motif.png')}}"); /* Replace with the path to the background image */
        background-repeat: repeat;
        background-position: top left;
        background-size: 400px 400px;
        padding-bottom: 220px;
        margin: 0;
      }
    </style>
</head>
<body>
    <nav
      class="bg-[#412F26] text-white py-3 px-6 flex flex-col md:flex-row justify-between items-center shadow-lg"
      style="background-color: #412f26"
    >
      <!-- Logo -->
      <div class="flex items-center justify-between w-full md:w-auto">
        <img
          src="{{ asset('asset/koffnes_putih.png') }}"
          alt="Koffnes Logo"
          class="h-8 md:h-10"
        />
        <button
          id="burger-menu"
          class="md:hidden text-white focus:outline-none"
          aria-label="Toggle Navigation"
        >
          <svg
            class="w-6 h-6"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16m-7 6h7"
            />
          </svg>
        </button>
      </div>

      <!-- Menu -->
      
    </nav>
    
    

<div class="px-8 py-6 pb-[4rem]">
    <div class="flex items-center justify-between mb-6">
        <div class="text-2xl font-semibold text-[#412f26]">
            Event
        </div>
        <!-- Add Event Button -->
        
    </div>

    <!-- Divider Line -->
    <hr class="border-t border-[#b18968] mb-8" />

    @if (count($events) == 0)
        <p>No Event Available</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-2 gap-6">
            @foreach ($events as $event)
                <div class="card bg-white shadow-lg relative overflow-hidden">
                    <!-- Image as background -->
                    <figure class="relative w-full h-72">
                        <img src="{{ asset('event/'.$event->banner_event) }}" alt="{{ $event->nama_event }}" class="absolute inset-0 w-full h-full object-cover" />
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white/90 via-white/60 to-transparent p-6 flex flex-col justify-end">
                            <!-- Text Content and Button Row -->
                            <div class="flex items-center justify-between w-full">
                                <!-- Text Content -->
                                <div class="text-left">
                                    <h2 class="text-[#412f26] font-bold text-xl">{{ $event->nama_event }}</h2>
                                    <hr class="border-t border-[#b18968] my-2" />
                                    <p class="text-[#412f26] text-sm mt-1">{{ $event->deskripsi_event }}</p>
                                </div>
                                <!-- Button -->
                                
                            </div>
                        </div>
                    </figure>
                </div>
            @endforeach
        </div>
    @endif
</div>


</body>
<footer
  class="w-full p-4 fixed bottom-0 left-0 z-30 flex flex-col items-center text-white"
  style="background-color: #412f26; height: 64px"
>
  <img
    src="{{asset('asset/koffnes_putih.png')}}"
    alt="Footer Logo"
    class="h-9 md:h-4 mb-2"
    style="max-width: 180px"
  />
  <p class="text-sm">&copy; 2024 Koffnes. All rights reserved.</p>
</footer>
</html>