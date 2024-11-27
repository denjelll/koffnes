@extends('layout.admin_navbar')
@section('title')
    Add User
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6 text-cocoa">
        Add User
    </div>
    <form action="{{ route('admin.store_user') }}" method="post" class="bg-[#f1e8d4] shadow-md rounded-lg p-6">
        @csrf
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p>{{ session('error') }}</p>
            </div>
        
        @endif
        <div class="mb-4">
            <label for="nama_depan" class="block text-cocoa text-sm font-bold mb-2">Nama Depan:</label>
            <input type="text" name="nama_depan" id="nama_depan" class="shadow appearance-none border rounded w-full py-2 px-3 text-cocoa leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="nama_belakang" class="block text-cocoa text-sm font-bold mb-2">Nama Belakang:</label>
            <input type="text" name="nama_belakang" id="nama_belakang" class="shadow appearance-none border rounded w-full py-2 px-3 text-cocoa leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="no_telepon" class="block text-cocoa text-sm font-bold mb-2">No Telepon:</label>
            <input type="text" name="no_telepon" id="no_telepon" class="shadow appearance-none border rounded w-full py-2 px-3 text-cocoa leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-cocoa text-sm font-bold mb-2">Email:</label>
            <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-cocoa leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block text-cocoa text-sm font-bold mb-2">Password:</label>
            <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-cocoa leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block text-cocoa text-sm font-bold mb-2">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-cocoa leading-tight focus:outline-none focus:shadow-outline" required>
        </div>
        
        <div class="mb-4">
            <label for="role" class="block text-cocoa text-sm font-bold mb-2">Role:</label>
            <select name="role" id="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-cocoa leading-tight focus:outline-none focus:shadow-outline" required>
                <option value="" disabled selected>-- Select Role --</option>
                <option value="Admin">Admin</option>
                <option value="Kasir">Cashier</option>
            </select>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-[#412f26] hover:bg-[#5a3e2f] text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Add User
            </button>
        </div>
    </form>
</div>
@endsection
