<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('storage/asset/gambar/icon.png') }}" type="image/x-icon">
    @vite('resources/css/app.css') 
    <style>
        .slide {
            display: none;
        }
        .slide.active {
            display: block;
        }

        html {
            overflow-y: scroll;
            scrollbar-width: none; /* Untuk Firefox */
        }

        html::-webkit-scrollbar {
            display: none; /* Untuk Chrome, Safari, dan Edge */
        }

        input::placeholder {
            color: grey;
            font-style: italic;
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
    
    </style>
    <title>Menu</title>
  </head>
  <body class="flex flex-col min-h-screen">
  <div
    class="fixed top-0 left-0 right-0 w-full text-white text-center h-12 flex items-center z-50"
    style="background-color: #412f26"
  >
    <!-- Dropdown -->
    <div class="relative flex items-center ml-4">
      <button 
        id="dropdownButton" 
        class="px-3 py-1  bg-natural rounded-lg font-semibold"
      >
        Menu
      </button>
      <div 
        id="dropdownMenu" 
        class="hidden absolute top-12 left-0 w-32 bg-white text-black rounded shadow-lg z-50"
      >
        <a href="#promo" class="block px-4 py-2 hover:bg-gray-200">Promo</a>
        <a href="#bundle" class="block px-4 py-2 hover:bg-gray-200">Bundle</a>
        <a href="#kopi" class="block px-4 py-2 hover:bg-gray-200">Coffee</a>
        <a href="#food" class="block px-4 py-2 hover:bg-gray-200">Food</a>
      </div>
    </div>

    <!-- Search Bar -->
    <div class="flex ml-4">
      <input 
        type="text" 
        placeholder="Search Menu..." 
        class="w-50 p-1 text-black rounded-xl focus:outline-none bg-coconut"              
      />
    </div>

    <img src="{{ asset('storage/asset/gambar/koffnes_putih.png') }}" alt="Koffnes Logo" class="h-6 ml-2" />
  </div>
    <!-- Content area -->
    <main class="flex-grow p-4">
      <!-- Slideshow Container -->
      <div
        class="w-100 h-52 bg-amber-100 rounded-xl shadow-lg relative overflow-hidden"
      >
        <!-- Slides -->
        <div
          class="slide active flex items-center justify-center h-full"
          style="
            background-image: url(https://png.pngtree.com/png-clipart/20210808/original/pngtree-wood-grain-creative-coffee-sale-banner-png-image_6617838.jpg);
            background-size: contain; /* Atur ukuran */
            background-repeat: no-repeat; /* Hindari pengulangan */
            background-position: center; /* Posisikan di tengah */
          "
        ></div>
        <div
          class="slide active flex items-center justify-center h-full"
          style="
            background-image: url(https://png.pngtree.com/png-clipart/20210808/original/pngtree-wood-grain-creative-coffee-sale-banner-png-image_6617838.jpg);
            background-size: contain; /* Atur ukuran */
            background-repeat: no-repeat; /* Hindari pengulangan */
            background-position: center; /* Posisikan di tengah */
          "
        ></div>
        <div
          class="slide active flex items-center justify-center h-full"
          style="
            background-image: url(https://img.freepik.com/premium-vector/realistic-vector-coffee-shop-menu-banner-template_313044-325.jpg);
            background-size: contain; /* Atur ukuran */
            background-repeat: no-repeat; /* Hindari pengulangan */
            background-position: center; /* Posisikan di tengah */
          "
        ></div>

        <!-- Indicators -->
        <div
          class="absolute bottom-2 left-0 right-0 flex justify-center space-x-2"
        >
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

      <!-- Best Seller Card Content -->
      <h1 class="text-3xl font-bold mb-4 mt-5" id="promo">Promo</h1>
      <div class="flex space-x-4">
        <x-customer_menu_card />
        <x-customer_menu_card />
      </div>
      <div class="flex space-x-4">
        <x-customer_menu_card />
        <x-customer_menu_card />
      </div>
      <!-- Bundling Card Content -->
      <h1 class="text-3xl font-bold mb-4 mt-5" id="bundle">Bundling & Deals</h1>
        <x-customer_bundle_card />
        <x-customer_bundle_card />
        <x-customer_bundle_card />
      <!-- Coffee Card Content -->
      <h1 class="text-3xl font-bold mb-4 mt-5" id="kopi">Coffee</h1>
      
      
    </main>

    <!-- Fixed Bottom Navbar -->
    <x-customer_navbar />

    <script>
      // JavaScript for dropdown menu
      const dropdownButton = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');

        // Toggle dropdown visibility on button click
        dropdownButton.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent the click from propagating to the document
            dropdownMenu.classList.toggle('hidden');
        });

        // Close dropdown if clicked outside of the menu
        document.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });


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