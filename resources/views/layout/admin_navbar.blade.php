<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <style>
      /* Force background color to white for body and .bg-base-100 */
      body,
      .bg-base-100 {
        background-color: white !important;
      }
      body {
        background-image: url("{{asset('storage/asset/gambar/motif.png')}}"); /* Replace with the path to the background image */
        background-repeat: repeat;
        background-position: top left;
        background-size: 400px 400px;
        padding-bottom: 350px;
        margin: 0;
      }
    </style>
</head>
<body>
    @if (session('role')!='Admin' || session('role')==null)
        <script>window.location = "/login";</script>
    @endif
    <nav
      class="bg-[#412F26] text-white py-3 px-6 flex flex-col md:flex-row justify-between items-center shadow-lg"
      style="background-color: #412f26"
    >
      <!-- Logo -->
      <div class="flex items-center justify-between w-full md:w-auto">
        <img
          src="{{ asset('storage/asset/gambar/koffnes_putih.png') }}"
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
      <div
        id="nav-links"
        class="hidden md:flex md:flex-row md:space-x-6 flex-col text-center mt-4 md:mt-0 w-full md:w-auto"
        style="background-color: "
      >
        <a href="{{ route('admin.menu') }}" class="hover:underline">Menu Management</a>
        <a href="{{ route('admin.kategori') }}" class="hover:underline">Kategori</a>
        <a href="{{ route('admin.promo') }}" class="hover:underline">Promotion</a>
        <a href="{{ route('admin.transaction') }}" class="hover:underline">Transaction Recap</a>
        <a href="{{ route('admin.user') }}" class="hover:underline">User Management</a>
        <a href="{{ route('admin.event') }}" class="hover:underline">Event Management</a>
        <a href="{{ route('admin.koffnesstatus') }}" class="hover:underline">Store Management</a>
        <a href="{{ route('admin.logout') }}" class="hover:underline text-[#CBB89D]">Logout</a>
      </div>
    </nav>
    
    @yield('content')
</body>
<footer
  class="w-full p-4 fixed bottom-0 left-0 z-30 flex flex-col items-center text-white"
  style="background-color: #412f26; height: 64px"
>
  <img
    src="{{asset('storage/asset/gambar/koffnes_putih.png')}}"
    alt="Footer Logo"
    class="h-9 md:h-4 mb-2"
    style="max-width: 180px"
  />
  <p class="text-sm">&copy; 2024 Koffnes. All rights reserved.</p>
</footer>
</html>