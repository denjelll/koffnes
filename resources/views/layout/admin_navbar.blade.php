<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('storage/asset/gambar/icon.png') }}">
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
        margin: 0;
        }
    </style>
    </head>
<body class="min-h-screen flex flex-col">
    @if (session('role')!='Admin' || session('role')==null)
        <script>window.location = "/login";</script>
    @endif
    <nav
      class="bg-[#412F26] w-full text-white py-3 px-6 flex flex-col md:flex-row justify-between items-center shadow-lg fixed z-50"
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
      >
        <a href="{{ route('admin.menu') }}" class="hover:underline">Menu Management</a>
        <a href="{{ route('admin.kategori') }}" class="hover:underline">Kategori</a>
        <a href="{{ route('admin.promo') }}" class="hover:underline">Promotion</a>
        <a href="{{ route('admin.transaction') }}" class="hover:underline">Transaction Recap</a>
        <a href="{{ route('admin.user') }}" class="hover:underline">User Management</a>
        <a href="{{ route('admin.event') }}" class="hover:underline">Event Management</a>
        <a href="{{ route('admin.koffnesstatus') }}" class="hover:underline">Store Management</a>
        <a href="{{ route('admin.logout') }}" class="hover:underline text-[#CBB89D]">
          <img src="{{ asset('storage/asset/gambar/logout.png') }}" alt="Logout" class="h-6 w-6">
        </a>
      </div>
      <script>
        const burgerMenu = document.getElementById("burger-menu");
        const navLinks = document.getElementById("nav-links");
        burgerMenu.addEventListener("click", () => {
        navLinks.classList.toggle("hidden");
        navLinks.classList.toggle("flex");
        });
      </script>
    </nav>
    
    <main class="flex-grow">
        @yield('content')
    </main>
    </body>
<footer class="bg-[#412f26] text-white py-4">
  <div class="container mx-auto text-center">
    <p class="text-sm font-medium">© 2024 Koffnes. Admin Panel.</p>
    <div class="flex justify-center mt-2 space-x-4">
      <a href="{{ route('admin.menu') }}" class="text-sm hover:underline">Menu Management</a>
      <a href="{{ route('admin.transaction') }}" class="text-sm hover:underline">Transcaction</a>
      <a href="{{ route('admin.logout') }}" class="text-sm hover:underline">Log out</a>
    </div>
    <p class="text-xs mt-4 opacity-75">Version 1.0.0 | All rights reserved.</p>
  </div>
</footer>

</html>