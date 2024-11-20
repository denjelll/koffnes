@extends('layout.admin_navbar')
@section('title')
    Event Management

@endsection
@section('content')
    <h1>Event Management</h1>
    <a href="{{ route('admin.add_event') }}">Add Event</a>
    <table>
        <tr>
            <th>No</th>
            <th>Nama Event</th>
            <th>Tanggal Event</th>
            <th>Action</th>
        </tr>
        @if (count($events) == 0)
            <tr>
                <td colspan="4">No data</td>
            </tr>
        
        @endif
        @foreach ($events as $event)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $event->nama_event }}</td>
                <td>{{ $event->tanggal_event }}</td>
                <td>
                    <a href="{{ route('admin.edit_event', $event->nama_event) }}">Edit</a>
                    <a href="{{ route('admin.delete_event', $event->nama_event) }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection