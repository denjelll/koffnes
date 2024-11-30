<div class="p-2 menu-card bg-[#FFF2E2] shadow-md rounded-lg overflow-hidden sm:w-1/2 md:w-1/3 lg:w-1/4 mx-auto" style="width: 100%;">
          <img
            src="{{ asset('menu/'.$menu->image) }}"
            alt="Foto Menu"
            class="w-full h-48 object-cover"
          />
            <div class="p-2">
            <h1 class="text-[#412f26] font-bold text-left text-sm sm:text-base">{{$menu->name}}</h1>
            <p class="text-[#412f26] text-sm sm:text-base">Rp. {{number_format($menu->price, 0, ',', '.')}}</p>
            <p class="text-sm text-gray-600 mt-2">
              {{$menu->description}}
            </p>
            <a class="btn btn-primary mt-2 rounded-full text-sm font-semibold transition duration-300 ease-in-out transform hover:scale-105 bg-[#412F26] text-white hover:bg-white hover:text-[#412F26] border-none shadow-lg active:scale-95 w-full text-center py-2" href="/menugate">
          Order Now
            </a>
          </div>
</div>