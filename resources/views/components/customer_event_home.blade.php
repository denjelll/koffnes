@php use Carbon\Carbon; @endphp

<div class="container p-5 items-center justify-center">
    <div class="relative w-92 rounded-lg overflow-hidden shadow-lg mt-5">
        <img src="{{ asset('event/'.$event->banner_event) }}" alt="Event Image" class="w-full h-56 object-cover" />
        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/70 to-transparent"></div>
        <div class="absolute bottom-4 left-4 right-4 text-gray-800">
            <h2 class="text-xl font-bold">{{ $event->nama_event }}</h2>
            <p class="text-sm mt-1">
                {{ \Illuminate\Support\Str::words($event->deskripsi_event, 7, '...') }}
            </p>
            <label for="event-modal-{{ $event->id_event }}" class="btn inline-block mt-3 p-4 text-white font-semibold rounded-lg shadow-md bg-cocoa cursor-pointer">
                See More
            </label>
        </div>
    </div>

    <!-- DaisyUI Modals -->
    <input type="checkbox" id="event-modal-{{ $event->id_event }}" class="modal-toggle">
    <div class="modal">
        <div class="modal-box relative">
            <label for="event-modal-{{ $event->id_event }}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="text-lg font-bold">{{ $event->nama_event }}</h3>
            <p class="text-sm text-gray-700 mt-2">
                {{ $event->deskripsi_event }}
            </p>
            
            <!-- Date & Time Section with Background per Span -->
            <div class="mt-4 text-center">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Tanggal & Waktu</h3>
                <div class="flex justify-center space-x-4">
                    <span class="flex items-center bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">
                        <i class="far fa-calendar-alt mr-1"></i>{{ Carbon::parse($event->tanggal_event)->translatedFormat('l, j F Y') }}
                    </span>
                    <span class="flex items-center bg-[#fff2e2] rounded-full px-3 py-1 text-gray-800 text-sm">
                        <i class="far fa-clock mr-1"></i>{{ Carbon::parse($event->jam_event)->format('H:i') }}
                    </span>
                </div>
            </div>
            
            <!-- Contact Section with Background per Span -->
            <div class="mt-4 text-center">
                <p class="text-lg font-semibold text-gray-800 mb-2">Informasi lebih lengkap:</p>
                <div class="flex items-center justify-center">
                    <span class="text-lg font-semibold text-gray-800 mr-4">IG:</span>
                    <a href="https://www.instagram.com/koffnes/"
                    target="_blank"
                    class="bg-[#fff2e2] rounded-full p-3 text-gray-800 text-sm">
                    @koffnes
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>


