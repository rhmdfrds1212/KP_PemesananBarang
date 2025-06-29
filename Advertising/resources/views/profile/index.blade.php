@extends('layout.main')

@section('title', 'Profil Saya')

@section('content')
<div class="container mt-5">
    <div class="row g-4 justify-content-center">

        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4 text-center">

                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=128" 
                        class="rounded-circle mb-3 shadow-sm" width="120" height="120" alt="Foto Profil">

                    <h3 class="card-title">{{ $user->name }}</h3>
                    <span class="badge bg-{{ $user->role == 'a' ? 'dark' : 'primary' }}">
                        {{ $user->role == 'a' ? 'Admin' : 'User' }}
                         {{ $user->role == 'a' ? 'Admin' : ($user->role == 'p' ? 'Pimpinan' : 'User') }}
                    </span>

                    <div class="mt-4 text-start">
                        <p><i class="bi bi-envelope me-2"></i><strong>Email:</strong> {{ $user->email }}</p>
                        <p><i class="bi bi-calendar-check me-2"></i><strong>Bergabung sejak:</strong> {{ $user->created_at->format('d M Y') }}</p>
                        <p><i class="bi bi-person-check-fill me-2"></i><strong>Status Akun:</strong> Aktif</p>
                    </div>

                    <div class="mt-4 d-flex flex-wrap justify-content-center gap-2">
                        <a href="{{ route('home.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-house-door"></i> Beranda
                        </a>
                        <a href="{{ route('profile.edit') }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i> Edit Profil
                        </a>
                        @if (Auth::user()->role === 'u')
                        <a href="{{ route('profile.histori') }}" class="btn btn-outline-success">
                            <i class="bi bi-clock-history"></i> Histori Transaksi
                        </a>
                        @endif
                        @if (Auth::user()->role === 'a' || Auth::user()->role === 'u')
                        <a href="{{ route('pemesanan.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-cart4"></i> Pemesanan
                        </a>
                        @endif
                        @if (Auth::user()->role === 'a' || Auth::user()->role === 'u')
                            <a href="{{ route('profile.invoice') }}" class="btn btn-outline-primary">
                                <i class="bi bi-file-earmark-text"></i> Invoice
                            </a>
                        @endif 
                        @if(Auth::user()->role === 'a')
                            <a href="{{ route('pelanggan.index') }}" class="btn btn-outline-dark">
                                <i class="bi bi-people-fill"></i> Kelola Pelanggan
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->role === 'u')
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">Ringkasan Akun</h5>

                    <div class="row text-center">
                        <div class="col">
                            <div class="p-3 bg-light rounded">
                                <i class="bi bi-cart-check fs-3 text-primary"></i>
                                <h6 class="mt-2 mb-0">Total Pemesanan</h6>
                                <span class="fw-bold">{{ $total_pemesanan ?? '0' }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 bg-light rounded">
                                <i class="bi bi-receipt fs-3 text-success"></i>
                                <h6 class="mt-2 mb-0">Total Transaksi</h6>
                                <span class="fw-bold">{{ $total_transaksi ?? '0' }}</span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="p-3 bg-light rounded">
                                <i class="bi bi-calendar-check fs-3 text-warning"></i>
                                <h6 class="mt-2 mb-0">Akun Sejak</h6>
                                <span class="fw-bold">{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if (Auth::user()->role === 'u')
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Aktivitas Terakhir</h5>
                    @if($histori->count() > 0)
                        <ul class="list-group">
                            @foreach($histori->take(5) as $item)
                                <li class="list-group-item">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Transaksi <strong>{{ $item->kode_transaksi }}</strong> - 
                                    Rp{{ number_format($item->total_harga, 0, ',', '.') }} 
                                    <span class="badge bg-info">{{ $item->created_at->format('d M Y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="text-end mt-2">
                            <a href="{{ route('profile.histori') }}" class="text-decoration-none">Lihat Semua</a>
                        </div>
                    @else
                        <p class="text-muted">Belum ada aktivitas transaksi.</p>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection