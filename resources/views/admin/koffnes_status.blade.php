@extends('layout.admin_navbar')
@section('title')
    Status Kafe
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Admin Dashboard
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-700">Status Sekarang: <span class="text-[#412f26]">{{ $status->status_koffnes }}</span></h3>
        </div>
        <form action="{{ route('admin.toggleStatus') }}" method="POST">
            @csrf
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ $status->status_koffnes === 'open' ? 'Tutup' : 'Buka' }}
            </button>
        </form>
    </div>
</div>
@endsection