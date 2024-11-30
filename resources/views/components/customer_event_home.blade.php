<div class="relative w-92 rounded-lg overflow-hidden shadow-lg mt-5">
        <img src="{{ asset('event/'.$event->banner_event) }}" alt="Event Image" class="w-full h-56 object-cover" />
        <div
          class="absolute inset-0 bg-gradient-to-t from-white via-white/70 to-transparent"
        ></div>
        <div class="absolute bottom-4 left-4 right-4 text-gray-800">
          <h2 class="text-xl font-bold">{{$event->nama_event}}</h2>
          <p class="text-sm mt-1">
            {{$event->deskripsi_event}}
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