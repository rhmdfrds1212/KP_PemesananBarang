@extends('layout.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5 text-center">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=128" 
                         class="rounded-circle mb-3 shadow-sm" width="120" height="120" alt="Foto Profil">

                    <h3 class="card-title">{{ $user->name }}</h3>
                    <span class="badge bg-{{ $user->role == 'a' ? 'dark' : 'primary' }}">
                        {{ $user->role == 'a' ? 'Admin' : 'User' }}
                    </span>

                    <div class="mt-4 text-start">
                        <p class="mb-2"><i class="bi bi-envelope me-2"></i><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="mb-0"><i class="bi bi-calendar-check me-2"></i><strong>Bergabung sejak:</strong> {{ $user->created_at->format('d M Y') }}</p>
                    </div>

                    <div class="mt-4 d-flex flex-wrap justify-content-center gap-2">
                        <a href="{{ route('home.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left-circle"></i> Kembali
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit Profil
                        </a>
                        <a href="{{ route('profile.histori') }}" class="btn btn-outline-success">
                            <i class="bi bi-clock-history"></i> Histori Transaksi
                        </a>
                        <a href="{{ route('pemesanan.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-cart4"></i> Pemesanan
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection