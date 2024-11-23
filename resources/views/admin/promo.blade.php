@extends('layout.admin_navbar')
@section('title')
    Promo
@endsection
@section('content')
<a href="{{route('admin.promo.add')}}">Add Promo</a>
@if ($promos->count() == 0)
    <p>No promo available</p>
@else
            @foreach ($promos as $promo)
                <div>
                <h2>{{ $promo->judul_promo }}</h2>
                    <p>{{ $promo->menu->nama_menu }}</p>
                    <img src="{{ asset('menu/' . $promo->menu->gambar) }}" alt="{{ $promo->menu->nama_menu }}" style="width: 100px; height: 100px;">
                        <input type="checkbox" class="toggle toggle-sm bg-[#593c2e]" data-id="{{ $promo->id_promo }}" {{ $promo->status == 'Aktif' ? 'checked' : '' }} />
                        <a href="{{ route('admin.promo.edit', $promo->judul_promo) }}">Edit</a>
    <a href="{{ route('admin.promo.delete', $promo->judul_promo) }}">Delete</a>
                </div>
            @endforeach
@endif
   

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
                .then(data => {
                    if (data.success) {
                        
                    } else {
                        
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    
                });
            });
        });
    </script>
@endsection