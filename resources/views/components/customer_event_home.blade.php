<div class="relative w-92 rounded-lg overflow-hidden shadow-lg mt-5">
        <img src="{{ asset('event/'.$event->banner_event) }}" alt="Event Image" class="w-full h-56 object-cover" />
        <div
          class="absolute inset-0 bg-gradient-to-t from-white via-white/70 to-transparent"
        ></div>
        <div class="absolute bottom-4 left-4 right-4 text-gray-800">
          <h2 class="text-xl font-bold">{{$event->nama_event}}</h2>
            <p class="text-sm mt-1">
            {{ \Illuminate\Support\Str::words($event->deskripsi_event, 7, '...') }}
            </p>
          <a
            href="#"
            class="inline-block mt-3 px-4 py-2 text-white font-semibold rounded-lg shadow-md hover:bg-brown-700"
            style="background-color: #412f26"
            onclick="openPopout('event1')"
          >
            See More
          </a>
        </div>
</div>

<div id="event1" class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
        <div class="bg-[#f5f0e8] rounded-lg p-4 w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg mx-auto">
            <!-- Content Section -->
            <div class="p-4 text-justify">
                <h3 class="text-lg font-semibold text-gray-800">{{$event->nama_event}}</h3>
                <p class="text-sm text-gray-700 mt-2">
                {{$event->deskripsi_event}}
                </p>
                
                <!-- Date & Time Section with Background per Span -->
                <div class="mt-4 text-center">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Date & Time</h3>
                    <div class="flex justify-center space-x-4">
                        <span class="flex items-center bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">
                            <i class="far fa-calendar-alt mr-1"></i>{{$event->tanggal_event}}
                        </span>
                        <span class="flex items-center bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">
                            <i class="far fa-clock mr-1"></i>{{$event->jam_event}}
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

    <script>
        function openPopout(eventId) {
            document.getElementById(eventId).classList.remove('hidden');
        }
        
        function closePopout(eventId) {
            document.getElementById(eventId).classList.add('hidden');
        }
    </script>