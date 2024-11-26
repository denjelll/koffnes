@extends('layout.admin_navbar')
@section('title')
    Event Management
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Event Management
    </div>
    <div class="flex items-center gap-4 mb-8">
        <!-- Add Event Button -->
        <a
            class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] cursor-pointer whitespace-nowrap"
            style="background-color: #412f26" href="{{ route('admin.add_event') }}"
        >
            Add Event
        </a>
    </div>
    @if (count($events) == 0)
        <p>No data</p>
    @else
        <div class="overflow-x-auto mx-auto max-w-6xl shadow-md border border-gray-300 rounded-lg">
            <table class="table-auto w-full text-center">
                <thead class="bg-[#412f26] text-white">
                    <tr>
                        <th class="p-4">No</th>
                        <th class="p-4">Nama Event</th>
                        <th class="p-4">Tanggal Event</th>
                        <th class="p-4">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white text-black">
                    @foreach ($events as $index => $event)
                        <tr class="border-b border-gray-300">
                            <td class="p-4">{{ $index + 1 }}</td>
                            <td class="p-4">{{ $event->nama_event }}</td>
                            <td class="p-4">{{ date('d F Y', strtotime($event->tanggal_event)) }}</td>
                            <td class="p-4">
                                <a href="{{ route('admin.edit_event', $event->nama_event) }}" class="text-[#412f26] hover:underline">Edit</a>
                                <a href="{{ route('admin.delete_event', $event->nama_event) }}" class="text-[#412f26] hover:underline">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection