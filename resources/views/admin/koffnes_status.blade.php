@extends ('layout.admin_navbar')
@section('title')
    Status Kafe
@endsection
@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>

        <h3>Status Sekarang: {{ $status->status_koffnes }}</h3>
        <form action="{{ route('admin.toggleStatus') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">
                {{ $status->status_koffnes === 'open' ? 'Tutup' : 'Buka' }}
            </button>
        </form>
    </div>
@endsection