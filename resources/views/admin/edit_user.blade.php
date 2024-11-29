@extends('layout.admin_navbar')
@section('title')
    Edit User
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Edit User
    </div>
    <form action="{{ route('admin.update_user', $user->id_user) }}" method="post" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        @endif
        <input type="hidden" name="id_user" value="{{ $user->id_user }}">
        <div class="mb-4">
            <label for="nama_depan" class="block text-gray-700 text-sm font-bold mb-2">Nama Depan:</label>
            <input type="text" name="nama_depan" id="nama_depan" value="{{ $user->nama_depan }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="nama_belakang" class="block text-gray-700 text-sm font-bold mb-2">Nama Belakang:</label>
            <input type="text" name="nama_belakang" id="nama_belakang" value="{{ $user->nama_belakang }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="no_telepon" class="block text-gray-700 text-sm font-bold mb-2">No Telepon:</label>
            <input type="text" name="no_telepon" id="no_telepon" value="{{ $user->no_telepon }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
            <select name="role" id="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Kasir" {{ $user->role == 'Cashier' ? 'selected' : '' }}>Cashier</option>
            </select>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Update User
            </button>
        </div>
    </form>
</div>
@endsection