<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
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
      <div
        id="nav-links"
        class="hidden md:flex md:flex-row md:space-x-6 flex-col text-center mt-4 md:mt-0 w-full md:w-auto"
        style="background-color: "
      >
        <a href="{{ route('admin.menu') }}" class="hover:underline">Menu Management</a>
        <a href="{{ route('admin.kategori') }}" class="hover:underline">Kategori</a>
        <a href="{{ route('admin.promo') }}" class="hover:underline">Promotion</a>
        <a href="{{ route('admin.user') }}" class="hover:underline">User Management</a>
        <a href="{{ route('admin.event') }}" class="hover:underline">Event Management</a>
        <a href="{{ route('admin.logout') }}" class="hover:underline text-[#CBB89D]">Logout</a>
      </div>
    </nav>
    
    @yield('content')
</body>
</html>