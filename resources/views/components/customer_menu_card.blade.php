<div class="p-2 menu-card bg-[#FFF2E2] shadow-md rounded-lg overflow-hidden sm:w-1/2 md:w-1/3 lg:w-1/4 mx-auto" style="width: 100%;">
          <img
            src="{{ asset('menu/'.$menu->image) }}"
            alt="Foto Menu"
            class="w-full h-48 object-cover"
          />
          <div class="pt-4 pb-4 p-4">
            <h1 class="text-[#412f26] font-bold text-left text-sm sm:text-base"">{{$menu->name}}</h1>
            <p class="text-[#412f26] text-sm sm:text-base">Rp. {{number_format($menu->price, 0, ',', '.')}}</p>
            <p class="text-sm text-gray-600 mt-2">
              {{$menu->description}}
            </p>
            <a class="mt-6 bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto flex items-center justify-center" href="/menugate">
          Order Now
            </a>
          </div>
</div>