<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css') 
    <style>
        html {
            overflow-y: scroll;
            scrollbar-width: none; /* Untuk Firefox */
        }

        html::-webkit-scrollbar {
            display: none; /* Untuk Chrome, Safari, dan Edge */
        }

      body {
        background-image: url("{{ asset('storage/asset/gambar/motif.png') }}");
        background-repeat: repeat;
        background-position: top left;
        background-size: 400px 400px;
        padding-bottom: 80px;
        padding-top: 60px;
        margin: 0;
      }

        input[type="radio"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid #412f26;
        background-color: white;
        position: relative;
        cursor: pointer;
    }

    input[type="radio"]:checked {
        background-color: #6a6f4c;
        border: 3px solid #412f26;
    }

    input[type="radio"]:checked::after {
        content: "";
        position: absolute;
        top: 4px;
        left: 4px;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background-color: #6a6f4c;
    }

    </style>
    <title>Cart</title>
  </head>
  <body class="flex flex-col min-h-screen">
    <div class="fixed top-0 left-0 w-full bg-cocoa flex items-center px-4 py-2 z-50 fixed">
        <button onclick="history.back()" style="color:white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <div class="font-semibold text-lg ml-4" style="color:white">
            Keranjang
        </div>
    </div>

    <!-- Card Makanan -->
    <div id="addonsCard" class="rounded-lg shadow-lg bg-coconut p-4 mt-4" style="margin-right: 20px; margin-left: 20px">
        <!-- Header: Menu Title and Price -->
        <div class="flex items-center mb-4">
            <img src="https://via.placeholder.com/50" alt="Menu Image" class="w-12 h-12 rounded-full">
            <div class="ml-4">
                <h2 class="font-semibold text-lg text-gray-800">Indomie Goreng</h2>
                <p class="text-gray-600">Rp. <span id="basePriceIndomie">11000</span></p>
            </div>
        </div>
        
        <!-- Addons Section -->
        <div class="mb-4">
            <h3 class="font-semibold text-gray-700">Tambahan</h3>
            <p class="text-sm" style="color:#6a6f4c;">*Pilih sesuai selera</p>
            <div class="space-y-2 mt-2">
                <!-- Option Telor Ceplok -->
                <div class="flex items-center justify-between">
                    <p class="text-gray-600">Telor Ceplok</p>
                    <div class="flex items-center">
                        <span class="text-gray-500 text-sm mr-2">Rp. 3000</span>
                        <button onclick="decreaseOption('telorCeplok', 3000, 'indomie')" class="w-6 h-6 flex items-center justify-center rounded-full mr-2" style="background: #6a6f4c; color:white;">
                            -
                        </button>
                        <span id="telorCeplokCount" class="mx-2 bg-gray-200 text-gray-800 w-6 h-6 flex items-center justify-center rounded-full">
                            0
                        </span>
                        <button onclick="increaseOption('telorCeplok', 3000, 'indomie')" class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full ml-2" style="background: #6a6f4c; color:white;">
                            +
                        </button>
                    </div>
                </div>
                <!-- Option Bakso -->
                <div class="flex items-center justify-between">
                    <p class="text-gray-600">Bakso</p>
                    <div class="flex items-center">
                        <span class="text-gray-500 text-sm mr-2">Rp. 5000</span>
                        <button onclick="decreaseOption('bakso', 5000, 'indomie')" class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full mr-2" style="background: #6a6f4c; color:white;">
                            -
                        </button>
                        <span id="baksoCount" class="mx-2 bg-gray-200 text-gray-800 w-6 h-6 flex items-center justify-center rounded-full">
                            0
                        </span>
                        <button onclick="increaseOption('bakso', 5000, 'indomie')" class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full ml-2" style="background: #6a6f4c; color:white;">
                            +
                        </button>
                    </div>
                </div>
                <!-- Option Sosis -->
                <div class="flex items-center justify-between">
                    <p class="text-gray-600">Sosis</p>
                    <div class="flex items-center">
                        <span class="text-gray-500 text-sm mr-2">Rp. 6000</span>
                        <button onclick="decreaseOption('sosis', 6000, 'indomie')" class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full mr-2" style="background: #6a6f4c; color:white;">
                            -
                        </button>
                        <span id="sosisCount" class="mx-2 bg-gray-200 text-gray-800 w-6 h-6 flex items-center justify-center rounded-full">
                            0
                        </span>
                        <button onclick="increaseOption('sosis', 6000, 'indomie')" class="bg-cocoa w-6 h-6 flex items-center justify-center rounded-full ml-2" style="background: #6a6f4c; color:white;">
                            +
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer: Total Price and Quantity -->
        <div class="flex items-center justify-between mt-4">
            <p class="font-semibold text-lg text-gray-800">Total: Rp. <span id="totalPriceIndomie">11000</span></p>
            <div class="flex items-center">
                <button onclick="decreaseQuantity('indomie')" class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full mr-2" style="color:white;">
                    -
                </button>
                <span id="indomieQuantity" class="mx-4 text-gray-800 font-semibold">1</span>
                <button onclick="increaseQuantity('indomie')" class="bg-cocoa w-8 h-8 flex items-center justify-center rounded-full ml-2" style="color:white;">
                    +
                </button>
            </div>
        </div>
    </div>

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
        <!-- Addons Section -->
        <div class="mb-4">
            <h3 class="font-semibold text-gray-700">Takaran Gula</h3>
            <p class="text-sm text-gray-500">*Pilih Salah Satu</p>
            <div class="space-y-2 mt-2">
                <div class="flex items-center justify-between">
                    <p class="text-gray-600">Sugar</p>
                    <div class="flex items-center">
                        <span class="text-gray-500 text-sm mr-2">Free</span>
                        <input type="radio" id="LessSugar" name="sugar" value="" class="form-radio text-[#6a6f4c] border-[#412f26] rounded-full w-5 h-5 focus:ring-[#6a6f4c]">
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-gray-600">Less Sugar</p>
                    <div class="flex items-center">
                        <span class="text-gray-500 text-sm mr-2">Free</span>
                        <input type="radio" id="LessSugar" name="sugar" value="" class="form-radio text-[#6a6f4c] border-[#412f26] rounded-full w-5 h-5 focus:ring-[#6a6f4c]">
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-gray-600">No Sugar</p>
                    <div class="flex items-center">
                        <span class="text-gray-500 text-sm mr-2">Free</span>
                        <input type="radio" id="LessSugar" name="sugar" value="" class="form-radio text-[#6a6f4c] border-[#412f26] rounded-full w-5 h-5 focus:ring-[#6a6f4c]">
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer: Total Price and Quantity -->
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

    <div class="fixed bottom-0 left-0 w-full bg-coconut py-4 px-4 flex justify-between items-center">
        <!-- Total Harga -->
        <div class="text-cocoa font-semibold text-lg">
            Total: Rp. <span id="totalPrice">21000</span>
        </div>

        <!-- Tombol Open Bill -->
        <button onclick="openBill()" class="bg-cocoa text-white px-6 py-2 rounded-lg font-semibold">
            Open Bill
        </button>
    </div>

    <script>
        let indomieQuantity = 1;
        let americanoQuantity = 1;
        let totalIndomie = 11000; // Base price Indomie
        let totalAmericano = 10000; // Base price Americano

        let telorCeplokPrice = 3000;
        let baksoPrice = 5000;
        let sosisPrice = 6000;

        // Update price based on quantity and addon choices
        function updatePrice() {
            document.getElementById("totalPriceIndomie").textContent = totalIndomie * indomieQuantity;
            document.getElementById("totalPriceAmericano").textContent = totalAmericano * americanoQuantity;
            document.getElementById("indomieQuantity").textContent = indomieQuantity;
            document.getElementById("americanoQuantity").textContent = americanoQuantity;
        }

        function increaseQuantity(product) {
            if (product === 'indomie') {
                indomieQuantity++;
            } else if (product === 'americano') {
                americanoQuantity++;
            }
            updatePrice();
        }

        function decreaseQuantity(product) {
            if (product === 'indomie' && indomieQuantity > 1) {
                indomieQuantity--;
            } else if (product === 'americano' && americanoQuantity > 1) {
                americanoQuantity--;
            }
            updatePrice();
        }

        function increaseOption(option, price, product) {
            if (product === 'indomie') {
                totalIndomie += price;
                document.getElementById(option + "Count").textContent = parseInt(document.getElementById(option + "Count").textContent) + 1;
            } else if (product === 'americano') {
                totalAmericano += price;
            }
            updatePrice();
        }

        function decreaseOption(option, price, product) {
            if (product === 'indomie' && parseInt(document.getElementById(option + "Count").textContent) > 0) {
                totalIndomie -= price;
                document.getElementById(option + "Count").textContent = parseInt(document.getElementById(option + "Count").textContent) - 1;
            } else if (product === 'americano') {
                totalAmericano -= price;
            }
            updatePrice();
        }

        function openBill() {
            alert("Bill is now open!"); 
        }
    </script>
</body>


</html>