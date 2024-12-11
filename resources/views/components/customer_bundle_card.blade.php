<div class="bg-[#FFF2E2] rounded-lg mt-4 p-4 relative overflow-hidden max-w-full sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl mx-auto">
  <img src="{{ asset('menu/'.$bundle->menu->gambar) }}" alt="Americano" class="w-full h-48 object-cover rounded-lg" />
  <div class="pt-4 mt-5">
    <h3 class="text-lg font-semibold text-gray-800">{{$bundle->menu->nama_menu}}</h3>
    <p class="text-green-800 text-lg">Rp. {{ number_format($bundle->menu->harga, 0, ',', '.') }}</p>
    <p class="text-sm text-gray-600 mt-1">{{$bundle->menu->deskripsi}}</p>
    <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="best-seller-controls">
      <!-- Initial ADD TO CART button (responsive size) -->
      <a class="btn btn-primary mt-2 px-6 py-2 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 md:hover:scale-100 bg-[#412F26] text-white hover:bg-white hover:text-[#412F26] border-none shadow-lg active:scale-95 w-full text-center" href="/menugate">
          Order Now
      </a>
      <!-- Quantity controls (hidden initially) -->
      <div class="hidden items-center space-x-1 qty-controls" id="controls-americano">
        <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm">-</button>
        <span id="qty-americano" class="text-sm font-semibold">0</span>
        <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm">+</button>
      </div>
    </div>
  </div>
</div>