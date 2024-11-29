@extends('layout.admin_navbar')
@section('title')
    Promo Management
@endsection
@section('content')


<div class="px-8 py-6 pb-[4rem]">
    <div class="text-2xl font-semibold mb-6" style="color: #412f26">
        Promo Management
    </div>
    <div class="flex items-center gap-4 mb-8">
        <!-- Add Promo Button -->
        <a
            class="bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f] cursor-pointer whitespace-nowrap"
            style="background-color: #412f26" href="{{ route('admin.promo.add')  }}"
        >
            Add Promo
        </a>
    </div>

    @if ($promos->count() == 0)
        <p>No promo available</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($promos as $promo)
                <div class="card w-60 bg-[#f1e8d4] shadow-md rounded-lg overflow-hidden" >
                    <div class="h-40 bg-gray-200 flex items-center justify-center">
                        <img src="{{ asset('menu/' . $promo->menu->gambar) }}" alt="{{ $promo->menu->nama_menu }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-[#412f26]">{{ $promo->judul_promo }}</h3>
                        <p class="text-gray-500 font-medium">{{ $promo->menu->nama_menu }}</p>
                    </div>
                    <div class="p-4 pt-0">
                        <input type="checkbox" class="toggle toggle-sm bg-[#593c2e]" data-id="{{ $promo->id_promo }}" {{ $promo->status == 'Aktif' ? 'checked' : '' }} />
                    </div>
                    <div class="p-4 pt-0">
                        <a href="{{ route('admin.promo.edit', $promo->judul_promo) }}"
                            class="btn bg-[#412f26] text-white w-full rounded-md hover:bg-[#593c2e]"
                            style="background-color: #412f26"
                        >
                            Edit
                        </a>
                    </div>
                    <div class="p-4 pt-0">
                        <a href="{{ route('admin.promo.delete', $promo->judul_promo) }}"
                            class="btn bg-[#412f26] text-white w-full rounded-md hover:bg-[#593c2e]"
                            style="background-color: #412f26"
                        >
                            Delete
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    document.querySelectorAll('.toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const promoId = this.getAttribute('data-id');
            const status = this.checked ? 'Aktif' : 'Tidak Aktif';

            fetch(`/admin/promo/update-status/${promoId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            // .then(data => {
            //     if (data.success) {

            //     } else {

            //     }
            // })
            .then(data => {
                if (data.success) {
                    // Show success modal
                    const modal = document.createElement('div');
                    modal.classList.add('fixed', 'inset-0', 'flex', 'items-center', 'justify-center', 'bg-black', 'bg-opacity-50');
                    modal.innerHTML = `
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <h2 class="text-xl font-semibold mb-4">Success</h2>
                            <p>Data has been successfully updated.</p>
                            <button class="mt-4 bg-[#412f26] text-white px-4 py-2 rounded-md hover:bg-[#5a3e2f]" id="closeModal">Close</button>
                        </div>
                    `;
                    document.body.appendChild(modal);

                    // Close modal on button click
                    document.getElementById('closeModal').addEventListener('click', () => {
                        document.body.removeChild(modal);
                    });
                } else {
                    alert('Failed to update status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update status');
            });
        });
    });
</script>
@endsection