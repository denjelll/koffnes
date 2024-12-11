<div class="p-2 menu-card bg-[#FFF2E2] shadow-md rounded-lg overflow-hidden w-9/12 md:w-1/3 lg:w-1/4 flex flex-col m-3">
  <!-- Gambar -->
  <div class="w-full h-48">
    <img
      src="{{ asset('menu/'.$menu->gambar) }}"
      alt="Foto Menu"
      class="w-full h-full object-cover"
    />
  </div>
  <!-- Konten -->
  <div class="p-2 flex flex-col flex-grow">
    <h1 class="text-[#412f26] font-bold text-left text-sm sm:text-base">
      {{ $menu->nama_menu }}
    </h1>
    <p class="text-[#412f26] text-sm sm:text-base">
      Rp. {{ number_format($menu->harga, 0, ',', '.') }}
    </p>
    <p class="text-sm text-gray-600 mt-2 overflow-hidden overflow-ellipsis whitespace-nowrap">
      {{ \Illuminate\Support\Str::limit($menu->deskripsi, 100, '...') }}
    </p>
    <!-- Tombol -->
    <a
      class="btn btn-primary mt-3 rounded-full text-sm font-semibold transition duration-300 ease-in-out transform hover:scale-105 bg-[#412F26] text-white hover:bg-white hover:text-[#412F26] border-none shadow-lg active:scale-95 w-full text-center py-2"
      href="/menugate"
    >
      Order Now
    </a>
  </div>
</div>
