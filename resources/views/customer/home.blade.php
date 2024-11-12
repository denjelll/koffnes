<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css') 
    <style>
      .slide {
        display: none;
      }
      .slide.active {
        display: block;
      }

            /* Hanya menyembunyikan scrollbar */
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
    </style>
    <title>Home</title>
  </head>
  <body class="flex flex-col min-h-screen">
    <!-- Content area -->
    <main class="flex-grow p-4">
      <x-customer_header />
      <!-- Slideshow Container -->
      <div
        class="w-100 h-60 bg-amber-100 rounded-xl shadow-lg relative overflow-hidden"
      >
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
      <h1 class="text-3xl font-bold mb-4 mt-5">Best Seller</h1>
      <div class="flex space-x-4">
        <x-customer_menu_card />
        <x-customer_menu_card />
      </div>
      <div class="flex space-x-4">
        <x-customer_menu_card />
        <x-customer_menu_card />
      </div>
      <!-- Bundling Card Content -->
      <h1 class="text-3xl font-bold mb-4 mt-5">Bundling & Deals</h1>
      <div
        class="mt-5 w-100 p-4 rounded-lg shadow-lg flex items-center"
        style="background-color: #fff2e2"
      >
        <div class="flex-shrink-0">
          <img
            src="#"
            alt="Coffee and Croissant"
            class="w-16 h-16 rounded-full"
          />
        </div>
        <div class="ml-4 flex-1">
          <h2 class="text-lg font-semibold text-brown-800">Kopi Croisant</h2>
          <p class="text-sm text-brown-600">
            Minuman andalan koffness<br />Seger bet
          </p>
          <p class="mt-2 text-lg font-semibold text-green-600">Rp. 15.000</p>
        </div>
        <button
          class="mt-20 ml-4 w-8 h-8 text-white rounded-full flex items-center justify-center"
          style="background-color: #412f26"
        >
          <span class="text-lg font-semibold mb-0.5">+</span>
        </button>
      </div>
      <div
        class="mt-5 w-100 p-4 rounded-lg shadow-lg flex items-center"
        style="background-color: #fff2e2"
      >
        <div class="flex-shrink-0">
          <img
            src="#"
            alt="Coffee and Croissant"
            class="w-16 h-16 rounded-full"
          />
        </div>
        <div class="ml-4 flex-1">
          <h2 class="text-lg font-semibold text-brown-800">Kopi Croisant</h2>
          <p class="text-sm text-brown-600">
            Minuman andalan koffness<br />Seger bet
          </p>
          <p class="mt-2 text-lg font-semibold text-green-600">Rp. 15.000</p>
        </div>
        <button
          class="mt-20 ml-4 w-8 h-8 text-white rounded-full flex items-center justify-center"
          style="background-color: #412f26"
        >
          <span class="text-lg font-semibold mb-0.5">+</span>
        </button>
      </div>
      <div
        class="mt-5 w-100 p-4 rounded-lg shadow-lg flex items-center"
        style="background-color: #fff2e2"
      >
        <div class="flex-shrink-0">
          <img
            src="#"
            alt="Coffee and Croissant"
            class="w-16 h-16 rounded-full"
          />
        </div>
        <div class="ml-4 flex-1">
          <h2 class="text-lg font-semibold text-brown-800">Kopi Croisant</h2>
          <p class="text-sm text-brown-600">
            Minuman andalan koffness<br />Seger bet
          </p>
          <p class="mt-2 text-lg font-semibold text-green-600">Rp. 15.000</p>
        </div>
        <button
          class="mt-20 ml-4 w-8 h-8 text-white rounded-full flex items-center justify-center"
          style="background-color: #412f26"
        >
          <span class="text-lg font-semibold mb-0.5">+</span>
        </button>
      </div>
      <!-- Event Card Content -->
      <h1 class="text-3xl font-bold mb-4 mt-5">Event News</h1>
      <div class="relative w-96 rounded-lg overflow-hidden shadow-lg mt-5">
        <img src="#" alt="Event Image" class="w-full h-56 object-cover" />
        <div
          class="absolute inset-0 bg-gradient-to-t from-white via-white/70 to-transparent"
        ></div>
        <div class="absolute bottom-4 left-4 right-4 text-gray-800">
          <h2 class="text-xl font-bold">Lomba Tekken 8 Koffnes</h2>
          <p class="text-sm mt-1">
            Lomba yang akan diadakan tanggal 10 Januari 2025, menangkan hadiah
            sebesar Rp.10.000.000
          </p>
          <a
            href="#"
            class="inline-block mt-3 px-4 py-2 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700"
            style="background-color: #412f26"
          >
            See More
          </a>
        </div>
      </div>
      <div class="relative w-96 rounded-lg overflow-hidden shadow-lg mt-5">
        <img src="#" alt="Event Image" class="w-full h-56 object-cover" />
        <div
          class="absolute inset-0 bg-gradient-to-t from-white via-white/70 to-transparent"
        ></div>
        <div class="absolute bottom-4 left-4 right-4 text-gray-800">
          <h2 class="text-xl font-bold">Lomba Tekken 8 Koffnes</h2>
          <p class="text-sm mt-1">
            Lomba yang akan diadakan tanggal 10 Januari 2025, menangkan hadiah
            sebesar Rp.10.000.000
          </p>
          <a
            href="#"
            class="inline-block mt-3 px-4 py-2 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700"
            style="background-color: #412f26"
          >
            See More
          </a>
        </div>
      </div>
      <div class="relative w-96 rounded-lg overflow-hidden shadow-lg mt-5">
        <img src="#" alt="Event Image" class="w-full h-56 object-cover" />
        <div
          class="absolute inset-0 bg-gradient-to-t from-white via-white/70 to-transparent"
        ></div>
        <div class="absolute bottom-4 left-4 right-4 text-gray-800">
          <h2 class="text-xl font-bold">Lomba Tekken 8 Koffnes</h2>
          <p class="text-sm mt-1">
            Lomba yang akan diadakan tanggal 10 Januari 2025, menangkan hadiah
            sebesar Rp.10.000.000
          </p>
          <a
            href="#"
            class="inline-block mt-3 px-4 py-2 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700"
            style="background-color: #412f26"
          >
            See More
          </a>
        </div>
      </div>
      <div class="flex items-center justify-center mt-3">
        <a
        href="#events"
        class="inline-block px-4 py-2 mt-4 text-white font-semibold" style="background-color: #412f26; border-radius: 15px; font-size: x-large;" 
      >
        See More Events
      </a>
      </div>
      
    </main>

    <!-- Fixed Bottom Navbar -->
    <x-customer_navbar />


    <script>
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