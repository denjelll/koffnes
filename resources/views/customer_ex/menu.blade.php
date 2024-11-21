<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Koffnes Menu</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .slide {
          display: none;
        }
        .slide.active {
          display: block;
    }
    body {
        background-color: #f1e7d1;
        background-image: url("{{ asset('storage/asset/gambar/motif.png') }}");
        background-repeat: repeat;
        background-position: top left;
        background-size: 400px 400px;
        padding-bottom: 80px;
        padding-top: 60px;
        margin: 0;
    }
  </style>
</head>
<body class="min-h-screen flex flex-col lg:flex-row bg-[#f1e7d1] scroll-smooth">
  <!-- Navbar Sidebar -->
  <div class="flex flex-col bg-[#4f3222] text-white w-20 lg:w-48 min-h-screen shadow-lg fixed top-0 z-10">
    <h2 class="text-sm lg:text-xl font-bold p-4 text-center flex items-center justify-center">Koffnes</h2>
    <nav class="flex-grow space-y-2 p-2 text-xs lg:text-base">
      <a href="#promo" class="block hover:bg-[#68472d] p-2 rounded">Promo</a>
      <a href="#happy-hour" class="block hover:bg-[#68472d] p-2 rounded">Happy Hour</a>
      <a href="#best-seller" class="block hover:bg-[#68472d] p-2 rounded">Best Seller</a>
      <a href="#coffee" class="block hover:bg-[#68472d] p-2 rounded">Coffee</a>
      <a href="#oatside-series" class="block hover:bg-[#68472d] p-2 rounded">Outside Series</a>
      <a href="#spanish-latte" class="block hover:bg-[#68472d] p-2 rounded">Spanish Latte Series</a>
      <a href="#noncoffee" class="block hover:bg-[#68472d] p-2 rounded">Noncoffee</a>
      <a href="#other" class="block hover:bg-[#68472d] p-2 rounded">Other</a>
    </nav>
  </div>
  
  <!-- Main Content Area -->
  <main class="flex-grow p-4">
    <!-- Slideshow Container -->
    <div class="ml-4 w-75 h-60  bg-amber-100 rounded-xl shadow-lg relative overflow-hidden">
      <!-- Slides -->
      <div class="slide active flex items-center justify-center h-full">
          <h2 class="text-2xl text-gray-700">Slide 1</h2>
        </div>
        <div class="slide flex items-center justify-center h-full">
          <h2 class="text-2xl text-gray-700">Slide 2</h2>
        </div>
        <div class="slide flex items-center justify-center h-full">
          <h2 class="text-2xl text-gray-700">Slide 3</h2>
        </div>

        <!-- Indicators -->
        <div class="absolute bottom-2 left-0 right-0 flex justify-center space-x-2">
            <span
            class="indicator h-2 w-2 bg-gray-500 rounded-full opacity-50 cursor-pointer"
            ></span>
            <span
            class="indicator h-2 w-2 bg-gray-500 rounded-full opacity-50 cursor-pointer"
            ></span>
            <span
            class="indicator h-2 w-2 bg-gray-500 rounded-full opacity-50 cursor-pointer"
            ></span>
        </div>
    </div>
    <!-- Main card-->
  <div class="flex-grow p-6 pt-24 lg:pt-6 ml-20 lg:ml-48">
    <!-- Promo Section -->
    <div id="promo" class="mb-6">
      <h2 class="text-2xl font-bold mb-4">Promo</h2>
      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
        <!-- Promo Item -->
        <div class="bg-[#f5dec3] rounded-lg shadow-lg p-4 relative">
          <img src="https://via.placeholder.com/150" alt="Nasi Lemak" class="w-full h-32 object-cover rounded-lg" />
          <div class="pt-4 pb-10">
            <h3 class="text-justify font-bold text-gray-800">Nasi Lemak</h3>
            <p class="text-green-800 text-lg">Rp 15.000</p>
            <p class="text-sm text-gray-600 mt-1">Menu andalan dengan beberapa lauk pauk.</p>
            <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="promo-controls">
              <!-- Initial ADD TO CART button (responsive size) -->
              <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto"
                      onclick="addItem(15000, 'nasi-lemak')" id="add-nasi-lemak">
                ADD TO CART
              </button>
              <!-- Quantity controls (small size) initially hidden -->
              <div class="hidden items-center space-x-1 qty-controls" id="controls-nasi-lemak">
                <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                        onclick="decreaseItem(15000, 'nasi-lemak')">-</button>
                <span id="qty-nasi-lemak" class="text-sm font-semibold">0</span>
                <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                        onclick="increaseItem(15000, 'nasi-lemak')">+</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Promo Item -->
        <div class="bg-[#f5dec3] rounded-lg shadow-lg p-4 relative">
            <img src="https://via.placeholder.com/150" alt="Nasi campur" class="w-full h-32 object-cover rounded-lg" />
            <div class="pt-4 pb-10">
              <h3 class="text-justify font-bold text-gray-800">Nasi kuning</h3>
              <p class="text-green-800 text-lg">Rp 15.000</p>
              <p class="text-sm text-gray-600 mt-1">Menu andalan dengan beberapa lauk pauk.</p>
              <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="promo-controls">
                <!-- Initial ADD TO CART button (responsive size) -->
                <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto"
                        onclick="addItem(15000, 'nasi-campur')" id="add-nasi-campur">
                  ADD TO CART
                </button>
                <!-- Quantity controls (small size) initially hidden -->
                <div class="hidden items-center space-x-1 qty-controls" id="controls-nasi-campur">
                  <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                          onclick="decreaseItem(15000, 'nasi-campur')">-</button>
                  <span id="qty-nasi-campur" class="text-sm font-semibold">0</span>
                  <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                          onclick="increaseItem(15000, 'nasi-campur')">+</button>
                </div>
              </div>
            </div>
          </div>
          <!-- Promo Item -->
          <div class="bg-[#f5dec3] rounded-lg shadow-lg p-4 relative">
            <img src="https://via.placeholder.com/150" alt="Nasi uduk" class="w-full h-32 object-cover rounded-lg" />
            <div class="pt-4 pb-10">
              <h3 class="text-justify font-bold text-gray-800">Nasi Uduk</h3>
              <p class="text-green-800 text-lg">Rp 15.000</p>
              <p class="text-sm text-gray-600 mt-1">Menu andalan dengan beberapa lauk pauk.</p>
              <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="promo-controls">
                <!-- Initial ADD TO CART button (responsive size) -->
                <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto"
                        onclick="addItem(15000, 'nasi-uduk')" id="add-nasi-uduk">
                  ADD TO CART
                </button>
                <!-- Quantity controls (small size) initially hidden -->
                <div class="hidden items-center space-x-1 qty-controls" id="controls-nasi-uduk">
                  <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                          onclick="decreaseItem(15000, 'nasi-uduk')">-</button>
                  <span id="qty-nasi-uduk" class="text-sm font-semibold">0</span>
                  <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                          onclick="increaseItem(15000, 'nasi-uduk')">+</button>
                </div>
              </div>
            </div>
          </div>
        <!-- Other Promo Items Here (similar structure) -->
      </div>
    </div>
  
    <!-- Best Seller Section -->
    <div id="best-seller" class="mb-6">
      <h2 class="text-2xl font-bold mb-4">Best Seller</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Best Seller Item -->
        <div class="bg-[#f5dec3] rounded-lg shadow-lg p-4 relative">
          <img src="https://via.placeholder.com/150" alt="Kopi Croisant" class="w-full h-32 object-cover rounded-lg" />
          <div class="pt-4 pb-10">
            <h3 class="text-lg font-semibold text-gray-800">Kopi Croisant</h3>
            <p class="text-green-800 text-lg">Rp 15.000</p>
            <p class="text-sm text-gray-600 mt-1">Minuman andalan koffness. Seger bet.</p>
            <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="best-seller-controls">
              <!-- Initial ADD TO CART button (responsive size) -->
                <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto" onclick="addItem(15000, 'kopi-croisant')" id="add-kopi-croisant">
                    ADD TO CART
                </button>
                <!-- Kontrol kuantitas (hidden initially) -->
                <div class="hidden items-center space-x-1 qty-controls" id="controls-kopi-croisant">
                    <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm" onclick="decreaseItem(15000, 'kopi-croisant')">-</button>
                    <span id="qty-kopi-croisant" class="text-sm font-semibold">0</span>
                    <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm" onclick="increaseItem(15000, 'kopi-croisant')">+</button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Other sections with IDs for scroll navigation -->
    <div id="happy-hour" class="mb-6">
      <h2 class="text-2xl font-bold mb-4">Happy Hour</h2>
      <!-- Content for Happy Hour section here -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Happy Hour Item -->
        <div class="bg-[#f5dec3] rounded-lg shadow-lg p-4 relative">
          <img src="https://via.placeholder.com/150" alt="Snack Bergembira" class="w-full h-32 object-cover rounded-lg" />
          <div class="pt-4 pb-10">
            <h3 class="text-lg font-semibold text-gray-800">Snack Bergembira</h3>
            <p class="text-green-800 text-lg">Rp 15.000</p>
            <p class="text-sm text-gray-600 mt-1">Snack paling nendang di koffnes.</p>
            <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="best-seller-controls">
              <!-- Initial ADD TO CART button (responsive size) -->
                <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto" onclick="addItem(15000, 'snack-bergembira')" id="add-snack-bergembira">
                    ADD TO CART
                </button>
              <!-- Quantity controls (hidden initially) -->
              <div class="hidden items-center space-x-1 qty-controls" id="controls-snack-bergembira">
                <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                        onclick="decreaseItem(15000, 'snack-bergembira')">-</button>
                <span id="qty-snack-bergembira" class="text-sm font-semibold">0</span>
                <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                        onclick="increaseItem(15000, 'snack-bergembira')">+</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Happy Hour Item -->
        <div class="bg-[#f5dec3] rounded-lg shadow-lg p-4 relative">
            <img src="https://via.placeholder.com/150" alt="Minum Enaq" class="w-full h-32 object-cover rounded-lg" />
            <div class="pt-4 pb-10">
              <h3 class="text-lg font-semibold text-gray-800">Minuman Hmm Enaq</h3>
              <p class="text-green-800 text-lg">Rp 15.000</p>
              <p class="text-sm text-gray-600 mt-1">Minuman andalan koffness. Seger bet.</p>
              <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="best-seller-controls">
              <!-- Initial ADD TO CART button (responsive size) -->
                <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto" onclick="addItem(15000, 'minum-enaq')" id="add-minum-enaq">
                    ADD TO CART
                </button>
                <!-- Quantity controls (hidden initially) -->
                <div class="hidden items-center space-x-1 qty-controls" id="controls-minum-enaq">
                  <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                          onclick="decreaseItem(15000, 'minum-enaq')">-</button>
                  <span id="qty-minum-enaq" class="text-sm font-semibold">0</span>
                  <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                          onclick="increaseItem(15000, 'minum-enaq')">+</button>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>

    <div id="coffee" class="mb-6">
      <h2 class="text-2xl font-bold mb-4">Coffee</h2>
      <!-- Content for Coffee section here -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Coffee Item -->
        <div class="bg-[#f5dec3] rounded-lg shadow-lg p-4 relative">
          <img src="https://via.placeholder.com/150" alt="Coffee Latte" class="w-full h-32 object-cover rounded-lg" />
          <div class="pt-4 pb-10">
            <h3 class="text-lg font-semibold text-gray-800">Coffee Latte</h3>
            <p class="text-green-800 text-lg">Rp 15.000</p>
            <p class="text-sm text-gray-600 mt-1">Minuman andalan koffness. Seger bet.</p>
            <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="best-seller-controls">
              <!-- Initial ADD TO CART button (responsive size) -->
                <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto" onclick="addItem(15000, 'coffee-latte')" id="add-coffee-latte">
                    ADD TO CART
                </button>
              <!-- Quantity controls (hidden initially) -->
              <div class="hidden items-center space-x-1 qty-controls" id="controls-coffee-latte">
                <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                        onclick="decreaseItem(15000, 'coffee-latte')">-</button>
                <span id="qty-coffee-latte" class="text-sm font-semibold">0</span>
                <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                        onclick="increaseItem(15000, 'coffee-latte')">+</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Coffee Item -->
        <div class="bg-[#f5dec3] rounded-lg shadow-lg p-4 relative">
            <img src="https://via.placeholder.com/150" alt="Americano" class="w-full h-32 object-cover rounded-lg" />
            <div class="pt-4 pb-10">
              <h3 class="text-lg font-semibold text-gray-800">Americano</h3>
              <p class="text-green-800 text-lg">Rp 15.000</p>
              <p class="text-sm text-gray-600 mt-1">Minuman andalan koffness. Seger bet.</p>
              <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="best-seller-controls">
              <!-- Initial ADD TO CART button (responsive size) -->
                <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto" onclick="addItem(15000, 'americano')" id="add-americano">
                    ADD TO CART
                </button>
                <!-- Quantity controls (hidden initially) -->
                <div class="hidden items-center space-x-1 qty-controls" id="controls-americano">
                  <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                          onclick="decreaseItem(15000, 'americano')">-</button>
                  <span id="qty-americano" class="text-sm font-semibold">0</span>
                  <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm"
                          onclick="increaseItem(15000, 'americano')">+</button>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
    <!-- Oatside Series Section -->
    <div id="oatside-series" class="mb-6">
      <h2 class="text-2xl font-bold mb-4">Oatside Series</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Oatside Item -->
        <div class="bg-[#e3d1c9] rounded-lg shadow-lg p-4 relative">
          <img src="https://via.placeholder.com/150" alt="Oatside Coffee" class="w-full h-32 object-cover rounded-lg" />
          <div class="pt-4 pb-10">
            <h3 class="text-lg font-semibold text-gray-800">Oatside Coffee</h3>
            <p class="text-green-800 text-lg">Rp 20.000</p>
            <p class="text-sm text-gray-600 mt-1">Minuman sehat berbasis oat milk.</p>
            <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="oatside-controls">
              <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto" onclick="addItem(20000, 'oatside-coffee')" id="add-oatside-coffee">
                ADD TO CART
              </button>
              <div class="hidden items-center space-x-1 qty-controls" id="controls-oatside-coffee">
                <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm" onclick="decreaseItem(20000, 'oatside-coffee')">-</button>
                <span id="qty-oatside-coffee" class="text-sm font-semibold">0</span>
                <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm" onclick="increaseItem(20000, 'oatside-coffee')">+</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Spanish Latte Series Section -->
    <div id="spanish-latte" class="mb-6">
      <h2 class="text-2xl font-bold mb-4">Spanish Latte Series</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Spanish Latte Item -->
        <div class="bg-[#f0e1c5] rounded-lg shadow-lg p-4 relative">
          <img src="https://via.placeholder.com/150" alt="Spanish Latte" class="w-full h-32 object-cover rounded-lg" />
          <div class="pt-4 pb-10">
            <h3 class="text-lg font-semibold text-gray-800">Spanish Latte</h3>
            <p class="text-green-800 text-lg">Rp 25.000</p>
            <p class="text-sm text-gray-600 mt-1">Espresso creamy dengan sentuhan cinnamon.</p>
            <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="spanish-latte-controls">
              <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto" onclick="addItem(25000, 'spanish-latte')" id="add-spanish-latte">
                ADD TO CART
              </button>
              <div class="hidden items-center space-x-1 qty-controls" id="controls-spanish-latte">
                <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm" onclick="decreaseItem(25000, 'spanish-latte')">-</button>
                <span id="qty-spanish-latte" class="text-sm font-semibold">0</span>
                <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm" onclick="increaseItem(25000, 'spanish-latte')">+</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Non-Coffee Section -->
    <div id="noncoffee" class="mb-6">
      <h2 class="text-2xl font-bold mb-4">Non-Coffee</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Non-Coffee Item -->
        <div class="bg-[#d4e6f1] rounded-lg shadow-lg p-4 relative">
          <img src="https://via.placeholder.com/150" alt="Matcha Latte" class="w-full h-32 object-cover rounded-lg" />
          <div class="pt-4 pb-10">
            <h3 class="text-lg font-semibold text-gray-800">Matcha Latte</h3>
            <p class="text-green-800 text-lg">Rp 18.000</p>
            <p class="text-sm text-gray-600 mt-1">Minuman non-kopi yang menyegarkan.</p>
            <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="matcha-latte-controls">
              <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto" onclick="addItem(18000, 'matcha-latte')" id="add-matcha-latte">
                ADD TO CART
              </button>
              <div class="hidden items-center space-x-1 qty-controls" id="controls-matcha-latte">
                <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm" onclick="decreaseItem(18000, 'matcha-latte')">-</button>
                <span id="qty-matcha-latte" class="text-sm font-semibold">0</span>
                <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm" onclick="increaseItem(18000, 'matcha-latte')">+</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Other Section -->
    <div id="other" class="mb-6">
      <h2 class="text-2xl font-bold mb-4">Other</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Other Item -->
        <div class="bg-[#f7e6d4] rounded-lg shadow-lg p-4 relative">
          <img src="https://via.placeholder.com/150" alt="Croissant" class="w-full h-32 object-cover rounded-lg" />
          <div class="pt-4 pb-10">
            <h3 class="text-lg font-semibold text-gray-800">Croissant</h3>
            <p class="text-green-800 text-lg">Rp 12.000</p>
            <p class="text-sm text-gray-600 mt-1">Cemilan ringan yang cocok dengan kopi.</p>
            <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-x-2 mt-4" id="croissant-controls">
              <button class="bg-[#4f3222] text-white rounded-lg py-2 px-4 text-xs sm:text-sm w-full sm:w-auto" onclick="addItem(12000, 'croissant')" id="add-croissant">
                ADD TO CART
              </button>
              <div class="hidden items-center space-x-1 qty-controls" id="controls-croissant">
                <button class="bg-red-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm" onclick="decreaseItem(12000, 'croissant')">-</button>
                <span id="qty-croissant" class="text-sm font-semibold">0</span>
                <button class="bg-green-500 text-white py-1 px-2 rounded-full text-xs sm:text-sm" onclick="increaseItem(12000, 'croissant')">+</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Cart Total -->
  <div class="fixed bottom-16 left-0 right-0 lg:left-48 bg-[#4f3222] text-white py-2 shadow-lg z-20" id="cart-total">
    <div class="flex justify-between items-center px-4">
      <span>Total: Rp <span id="total-amount">0</span></span>
      <img src="https://via.placeholder.com/30" class="w-8 h-8" alt="cart" />
    </div>
  </div>

  <!-- Footer -->
  <x-customer_navbar />

  <!-- JavaScript for Cart Functionality -->
  <script>
let totalAmount = 0; // Total harga
const totalElement = document.getElementById('total-amount');
const cartTotal = document.getElementById('cart-total');

// Fungsi untuk memperbarui tampilan elemen total keranjang
function updateCartDisplay() {
  if (totalAmount > 0) {
    cartTotal.classList.remove('hidden'); // Tampilkan elemen "Total"
  } else {
    cartTotal.classList.add('hidden'); // Sembunyikan elemen "Total"
  }
  totalElement.textContent = totalAmount; // Perbarui nilai total
}

// Pastikan elemen #cart-total disembunyikan saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
  cartTotal.classList.add('hidden'); // Sembunyikan elemen "Total" saat pertama kali halaman dimuat
});

// Fungsi untuk menambahkan item ke keranjang
function addItem(price, itemId) {
  const addButton = document.getElementById(`add-${itemId}`);
  const controls = document.getElementById(`controls-${itemId}`);
  const qtySpan = document.getElementById(`qty-${itemId}`);
  
  addButton.classList.add('hidden');  // Sembunyikan tombol "Add to Cart"
  controls.classList.remove('hidden'); // Tampilkan kontrol jumlah
  qtySpan.textContent = 1; // Set jumlah awal item
  totalAmount += price; // Tambah harga item ke total
  updateCartDisplay(); // Perbarui tampilan keranjang
}

// Fungsi untuk menambah jumlah item
function increaseItem(price, itemId) {
  const qtySpan = document.getElementById(`qty-${itemId}`);
  let qty = parseInt(qtySpan.textContent);
  qty++;
  qtySpan.textContent = qty;
  totalAmount += price; // Tambahkan harga item ke total
  updateCartDisplay(); // Perbarui tampilan keranjang
}

// Fungsi untuk mengurangi jumlah item
function decreaseItem(price, itemId) {
  const qtySpan = document.getElementById(`qty-${itemId}`);
  let qty = parseInt(qtySpan.textContent);
  if (qty > 0) {
    qty--;
    qtySpan.textContent = qty;
    totalAmount -= price; // Kurangi harga item dari total
    updateCartDisplay(); // Perbarui tampilan keranjang
  }
  // Jika jumlah item 0, sembunyikan kontrol dan tampilkan tombol "Add to Cart"
  if (qty === 0) {
    const addButton = document.getElementById(`add-${itemId}`);
    const controls = document.getElementById(`controls-${itemId}`);
    addButton.classList.remove('hidden'); // Tampilkan tombol "Add to Cart"
    controls.classList.add('hidden'); // Sembunyikan kontrol jumlah
  }
}

    // JavaScript for slideshow functionality
        const slides = document.querySelectorAll(".slide");
        const indicators = document.querySelectorAll(".indicator");
        let currentIndex = 0;

        // Function to show the active slide
        function showSlide(index) {
          slides.forEach((slide, i) => {
            slide.classList.toggle("active", i === index);
            indicators[i].classList.toggle("bg-green-600", i === index);
            indicators[i].classList.toggle("opacity-100", i === index);
            indicators[i].classList.toggle("opacity-50", i !== index);
          });
        }

        // Handle indicator clicks
        indicators.forEach((indicator, i) => {
          indicator.addEventListener("click", () => {
            currentIndex = i;
            showSlide(currentIndex);
          });
        });

        // Function to handle swipe left and right
        let touchStartX = 0;
        let touchEndX = 0;

        function handleSwipe() {
          if (touchEndX < touchStartX) {
            // Swiped left, go to next slide
            currentIndex = (currentIndex + 1) % slides.length;
          }
          if (touchEndX > touchStartX) {
            // Swiped right, go to previous slide
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
          }
          showSlide(currentIndex);
        }

        // Add event listeners for touch events
        slides.forEach((slide) => {
          slide.addEventListener("touchstart", (e) => {
            touchStartX = e.touches[0].clientX; // Record the touch start position
          });

          slide.addEventListener("touchend", (e) => {
            touchEndX = e.changedTouches[0].clientX; // Record the touch end position
            handleSwipe(); // Determine swipe direction and show the appropriate slide
          });
        });

        // Auto-slide functionality: move to the next slide every 5 seconds
        function autoSlide() {
          currentIndex = (currentIndex + 1) % slides.length; // Move to the next slide
          showSlide(currentIndex);
        }

        // Set the interval for auto-sliding (every 5 seconds)
        let autoSlideInterval = setInterval(autoSlide, 5000);

        // Reset the interval after swipe to continue auto sliding
        slides.forEach((slide) => {
          slide.addEventListener("touchstart", () => {
            clearInterval(autoSlideInterval); // Stop the auto-slide when swipe starts
          });
          slide.addEventListener("touchend", () => {
            autoSlideInterval = setInterval(autoSlide, 5000); // Restart the auto-slide after swipe
          });
        });

        // Initial display
        showSlide(currentIndex);
  </script>
</body>
</html>
