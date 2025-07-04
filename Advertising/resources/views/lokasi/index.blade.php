@extends('layout.main')

@section('title', 'Lokasi')

@section('content')
<div class="container mt-4">
    <h1 class="text-center fw-bold mb-4">TITIK LOKASI</h1>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <form method="GET" action="{{ route('lokasi.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan produk (baliho, billboard, videotron)"
                value="{{ request('search') }}">
            <button class="btn btn-outline-success" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </div>
    </form>

    @if (Auth::check() && Auth::user()->role === 'a')
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('lokasi.create') }}" class="btn btn-success">
                + Tambah Lokasi
            </a>
        </div>
    @endif

    <div class="row">
        @foreach ($lokasi as $item)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm">
                <a href="{{ asset('storage/' . $item->foto) }}" target="_blank">
                    <img src="{{ asset('storage/' . $item->foto) }}" 
                        class="card-img-top" 
                        alt="{{ $item->produk_nama }}" 
                        style="height: 300px; object-fit: cover;">
                </a>
                <div class="card-body text-center">
                    <h5 class="fw-bold">{{ ucfirst($item->produk_nama) }}</h5>
                    <p class="mb-1">{{ $item->alamat }}</p>
                    
                    <div class="mb-2">
                        <span class="badge bg-primary">
                            Ukuran: {{ $item->ukuran }}
                        </span>
                    </div>

                    @if($item->status == 'tersedia')
                        <span class="badge bg-success">Tersedia</span>
                    @elseif($item->status == 'tersewa' || $item->status == 'tidak tersedia')
                        <span class="badge bg-danger">Tersewa</span>
                    @else
                        <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                    @endif

                    @if (Auth::check() && Auth::user()->role === 'a')
                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <a href="{{ route('lokasi.edit', $item->id) }}" 
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>

                        <form action="{{ route('lokasi.destroy', $item->id) }}" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus lokasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection