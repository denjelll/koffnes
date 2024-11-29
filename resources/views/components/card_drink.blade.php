<!-- Card Minuman -->
<div id="addonsCard" class="rounded-lg shadow-lg bg-coconut p-4 mt-4" style="margin-right: 20px; margin-left: 20px;">
    <!-- Header: Menu Title and Price -->
    <div class="flex items-center mb-4">
        <img src="https://via.placeholder.com/50" alt="Menu Image" class="w-12 h-12 rounded-full">
        <div class="ml-4">
            <h2 class="font-semibold text-lg text-gray-800">Kopi Americano</h2>
            <p class="text-gray-600">Rp. <span id="basePriceAmericano">10000</span></p>
        </div>
    </div>
        <div class="items-center justify-between mt-4">
        <label for="notes" class="text-cocoa font-semibold">Catatan:</label><br>
        <textarea id="notes" name="notes" rows="5" class="w-full p-2 border border-gray-300 rounded-md resize-none"></textarea>
    </div>
    <div class="flex items-center justify-between mt-4">
        <p class="font-semibold text-lg text-gray-800">Total: Rp. <span id="totalPriceAmericano">10000</span></p>
        <div class="flex items-center">
            <button onclick="decreaseQuantity('americano')" class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full mr-2" style="color:white;">
                -
            </button>
            <span id="americanoQuantity" class="mx-4 text-gray-800 font-semibold">1</span>
            <button onclick="increaseQuantity('americano')" class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full ml-2" style="color:white;">
                +
            </button>
        </div>
    </div>
</div>