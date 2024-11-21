<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koffnes Event Pages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body{
            background-image: url("D:/File UMN/bg kopi.jpg"); /* Replace this with the path to the background image */
            background-repeat: repeat;
            background-position: top left;
            background-size: 400px 400px;
            padding-bottom: 80px;
            padding-top: 60px;
            margin: 0;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <!-- Header/Navbar -->
    <div class="fixed top-0 left-0 right-0 w-full text-white text-center h-12 flex items-center justify-center bg-[#412f26]">
        <img src="D:\File UMN\koffness2.png" alt="Koffnes Logo" class="h-8" />
    </div>
    
    <!-- Event News Section -->
        <main class="flex-grow p-4">
            <h1 class="text-3xl font-bold mb-4 mt-5">Events</h1>
                <!-- New Event Card -->
                <div class="relative w-96 rounded-lg overflow-hidden shadow-lg mt-5 ">
                    <img src="#" alt="Event Image" class="w-full h-56 object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-white via-white/70 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-gray-800">
                        <h2 class="text-xl font-bold">Lomba Catur Koffnes</h2>
                        <p class="text-sm mt-1">
                            Lomba yang akan diadakan tanggal 10 Januari 2025, menangkan hadiah sebesar Rp.10.000.000
                        </p>
                        <button onclick="openPopout('event1')" class="inline-block mt-3 px-4 py-2 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700" style="background-color: #412f26">See Detail</button>
                    </div>
                </div>
                <!-- New Event Card -->
                <div class="relative w-96 rounded-lg overflow-hidden shadow-lg mt-5">
                    <img src="#" alt="Event Image" class="w-full h-56 object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-white via-white/70 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-gray-800">
                        <h2 class="text-xl font-bold">Lomba Billiar Koffnes</h2>
                        <p class="text-sm mt-1">
                            Lomba yang akan diadakan tanggal 10 Januari 2025, menangkan hadiah sebesar Rp.10.000.000
                        </p>
                        <button onclick="openPopout('event2')" class="inline-block mt-3 px-4 py-2 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700" style="background-color: #412f26">See Detail</button>
                    </div>
                </div>
                <!-- New Event Card -->
                <div class="relative w-96 rounded-lg overflow-hidden shadow-lg mt-5">
                    <img src="#" alt="Event Image" class="w-full h-56 object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-white via-white/70 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-gray-800">
                        <h2 class="text-xl font-bold">Lomba Tekken 8 Koffnes</h2>
                        <p class="text-sm mt-1">
                            Lomba yang akan diadakan tanggal 10 Januari 2025, menangkan hadiah sebesar Rp.10.000.000
                        </p>
                        <button onclick="openPopout('event3')" class="inline-block mt-3 px-4 py-2 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700" style="background-color: #412f26">See Detail</button>
                    </div>
                </div>
    <!-- Pop-out Card with Styled Layout -->
    <div id="event1" class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
        <div class="bg-[#f5f0e8] rounded-lg p-4 w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg mx-auto">
            <!-- Image Section -->
            <img src="your-image-url.jpg" alt="Chess Competition Image" class="rounded-t-lg w-full h-40 object-cover" />
            
            <!-- Content Section -->
            <div class="p-4 text-justify">
                <h3 class="text-lg font-semibold text-gray-800">Catur Competition</h3>
                <p class="text-sm text-gray-700 mt-2">
                    Catur adalah salah satu permainan papan tertua di dunia dan menjadi yang paling populer. Bila Anda ingin belajar catur untuk bermain dengan teman-teman Anda atau untuk mengikuti kejuaraan, di dalam artikel ini Anda dapat mengetahui seluruh informasi yang perlu Anda ketahui tentang catur.
                </p>
                
                <!-- Date & Time Section with Background per Span -->
                <div class="mt-4 text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Date & Time</h3>
                    <div class="flex justify-center space-x-4">
                        <span class="flex items-center bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">
                            <i class="far fa-calendar-alt mr-1"></i> 20/11/2024
                        </span>
                        <span class="flex items-center bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">
                            <i class="far fa-clock mr-1"></i> 18:00 WIB
                        </span>
                    </div>
                </div>
                
                <!-- Contact Section with Background per Span -->
                <div class="mt-4 text-center">
                    <p class="text-lg font-semibold text-gray-800 mb-2">Daftar disini</p>
                    <div class="flex justify-center space-x-2">
                        <span class="text-lg font-semibold text-gray-800 mb-2">WA:</span>
                        <span class="bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">082220202202</span>
                    </div>
                </div>

                <!-- Close Button -->
                <button onclick="closePopout('event1')" class="mt-4 bg-[#412f26] hover:bg-[#301c1c] text-white py-1 px-4 rounded w-full">Close</button>
            </div>
        </div>
    </div>

    <!-- Pop-out Card with Styled Layout -->
    <div id="event2" class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
        <div class="bg-[#f5f0e8] rounded-lg p-4 w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg mx-auto">
            <!-- Image Section -->
            <img src="your-image-url.jpg" alt="Chess Competition Image" class="rounded-t-lg w-full h-40 object-cover" />
            
            <!-- Content Section -->
            <div class="p-4 text-justify">
                <h3 class="text-lg font-semibold text-gray-800">Billiard Competition</h3>
                <p class="text-sm text-gray-700 mt-2">Billiar adalah suatu game yang dimainkan oleh 2 orang atau lebih dan bertujuan untuk memasukkan bola secara berurutan</p>
                
                <!-- Date & Time Section with Background per Span -->
                <div class="mt-4 text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Date & Time</h3>
                    <div class="flex justify-center space-x-4">
                        <span class="flex items-center bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">
                            <i class="far fa-calendar-alt mr-1"></i> 20/11/2024
                        </span>
                        <span class="flex items-center bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">
                            <i class="far fa-clock mr-1"></i> 18:00 WIB
                        </span>
                    </div>
                </div>
                
                <!-- Contact Section with Background per Span -->
                <div class="mt-4 text-center">
                    <p class="text-lg font-semibold text-gray-800 mb-2">Daftar disini</p>
                    <div class="flex justify-center space-x-2">
                        <span class="text-lg font-semibold text-gray-800 mb-2">WA:</span>
                        <span class="bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">082220202202</span>
                    </div>
                </div>

                <!-- Close Button -->
                <button onclick="closePopout('event2')" class="mt-4 bg-[#412f26] hover:bg-[#301c1c] text-white py-1 px-4 rounded w-full">Close</button>
            </div>
        </div>
    </div>

    <!-- Pop-out Card with Styled Layout -->
    <div id="event3" class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
        <div class="bg-[#f5f0e8] rounded-lg p-4 w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg mx-auto">
            <!-- Image Section -->
            <img src="your-image-url.jpg" alt="Chess Competition Image" class="rounded-t-lg w-full h-40 object-cover" />
            
            <!-- Content Section -->
            <div class="p-4 text-justify">
                <h3 class="text-lg font-semibold text-gray-800">Tekken 8 Competition</h3>
                <p class="text-sm text-gray-700 mt-2">Tekken 8 adalah game console yang dimainkan oleh 2 orang dengan menggunakan combo agar bisa memenangkan gamenya</p>
                
                <!-- Date & Time Section with Background per Span -->
                <div class="mt-4 text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Date & Time</h3>
                    <div class="flex justify-center space-x-4">
                        <span class="flex items-center bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">
                            <i class="far fa-calendar-alt mr-1"></i> 20/11/2024
                        </span>
                        <span class="flex items-center bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">
                            <i class="far fa-clock mr-1"></i> 18:00 WIB
                        </span>
                    </div>
                </div>
                
                <!-- Contact Section with Background per Span -->
                <div class="mt-4 text-center">
                    <p class="text-lg font-semibold text-gray-800 mb-2">Daftar disini</p>
                    <div class="flex justify-center space-x-2">
                        <span class="text-lg font-semibold text-gray-800 mb-2">WA:</span>
                        <span class="bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">082220202202</span>
                    </div>
                </div>

                <!-- Close Button -->
                <button onclick="closePopout('event3')" class="mt-4 bg-[#412f26] hover:bg-[#301c1c] text-white py-1 px-4 rounded w-full">Close</button>
            </div>
        </div>
    </div>
    </main>

    <!-- Footer Navbar -->
    <nav class="fixed bottom-0 left-0 right-0 text-white shadow-lg" style="background-color: #412f26">
        <div class="flex justify-around items-center py-4">
            <a href="#" class="text-center flex flex-col items-center">
                <img src="home.png" width="24" height="24" class="mb-1"/>
                <span class="text-sm">Home</span>
            </a>
            <a href="#" class="text-center flex flex-col items-center">
                <img src="menu.png" width="24" height="24" class="mb-1"/>
                <span class="text-sm">Menu</span>
            </a>
            <a href="#" class="text-center flex flex-col items-center">
                <img src="event.png" width="24" height="24" class="mb-1"/>
                <span class="text-sm">Events</span>
            </a>
        </div>
    </nav>

    <script>
        function openPopout(eventId) {
            document.getElementById(eventId).classList.remove('hidden');
        }
        
        function closePopout(eventId) {
            document.getElementById(eventId).classList.add('hidden');
        }
    </script>
</body>
</html>