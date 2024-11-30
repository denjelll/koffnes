<div
          class="w-1r rounded-lg shadow-lg overflow-hidden mt-5"
          style="background-color: #fff2e2; box-shadow: 8px 10px 0px -2px rgba(106,111,76,0.72);
-webkit-box-shadow: 8px 10px 0px -2px rgba(106,111,76,0.72);
-moz-box-shadow: 8px 10px 0px -2px rgba(106,111,76,0.72);"
        >
          <img
            src="{{ asset('menu/'.$menu->image) }}"
            alt="Foto Menu"
            class="w-full h-48 object-cover"
          />
          <div class="p-4">
            <h3 class="text-xl font-semibold text-gray-800">{{$menu->name}}</h3>
            <p class="text-lg text-green-600 items-center">Rp. {{number_format($menu->price, 0, ',', '.')}}</p>
            <p class="text-sm text-gray-600 mt-2">
              {{$menu->description}}
            </p>
            <!-- <button
              class="mt-4 w-full py-2 text-white rounded-lg"
              style="background-color: #412f26"
            >
              Add to Cart
            </button> -->
            <!-- <div class="flex items-center mt-4 ml-4">
                <button onclick="" class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full mr-2" style="color:white;">
                    -
                </button>
                <span id="americanoQuantity" class="mx-4 text-gray-800 font-semibold">1</span>
                <button onclick="" class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full ml-2" style="color:white;">
                    +
                </button>
            </div> -->
          </div>
</div>