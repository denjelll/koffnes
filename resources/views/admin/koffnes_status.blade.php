@extends('layout.admin_navbar')
@section('title')
    Status Kafe
@endsection
@section('content')
<div class="flex flex-col justify-center items-center min-h-screen px-4 py-6">
    <div class="text-3xl font-semibold mb-8 text-[#412f26]">
        Status Koffnes
    </div>
    <div class="bg-[#f1e8d4] shadow-lg rounded-lg p-8 w-full max-w-lg">
        <div class="mb-6 text-center">
            <h3 class="text-xl font-semibold text-gray-700">Status Sekarang: 
                <span class="text-[#412f26]">{{ $status->status_koffnes }}</span>
            </h3>
        </div>
        <form action="{{ route('admin.toggleStatus') }}" method="POST" class="flex justify-center">
            @csrf
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-6 rounded-full transition duration-300 ease-in-out focus:outline-none focus:shadow-outline">
                {{ $status->status_koffnes === 'open' ? 'Tutup' : 'Buka' }}
            </button>
        </form>
    </div>
</div>
@endsection
