@extends('layout.admin_navbar')
@section('title')
    User Management
@endsection
@section('content')
<div class="px-8 py-6 pb-[4rem] pt-[5rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        User Management
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <div class="flex items-center gap-4 mb-8">
        <!-- Add User Button -->
        <a
            class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] cursor-pointer whitespace-nowrap"
            style="background-color: #412f26" href="{{ route('admin.add_user') }}"
        >
            Add User
        </a>
    </div>
    <div class="overflow-x-auto mx-auto max-w-6xl shadow-md border border-gray-300 rounded-lg">
        <table class="table-auto w-full text-center">
            <thead class="bg-[#412f26] text-white">
                <tr>
                    <th class="p-4">Nama User</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">No Telepon</th>
                    <th class="p-4">Role</th>
                    <th class="p-4">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white text-black">
                @foreach ($users as $user)
                @if ($user->id_user > 1)
                <tr class="border-b border-gray-300">
                    <td class="p-4">{{ $user->nama }}</td>
                    <td class="p-4">{{ $user->email }}</td>
                    <td class="p-4">{{ $user->no_telepon }}</td>
                    <td class="p-4">{{ $user->role }}</td>
                    <td class="p-4">
                        <a href="{{ route('admin.edit_user', $user->nama_depan) }}" class="text-[#412f26] hover:underline">Edit</a>
                        @if (Session::get('id_user')!= $user->id_user)
                            <button onclick="showDeleteModal('{{ route('admin.delete_user', $user->nama_depan) }}')" class="text-[#412f26] hover:underline">Delete</button>
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
        <p class="mb-4">Apakah Anda yakin ingin menghapus user ini?</p>
        <div class="flex justify-end">
            <button onclick="hideDeleteModal()" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Batal</button>
            <a id="deleteLink" href="#" class="bg-red-500 text-white px-4 py-2 rounded">Hapus</a>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(deleteUrl) {
        document.getElementById('deleteLink').href = deleteUrl;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function hideDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection