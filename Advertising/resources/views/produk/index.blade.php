@extends('layout.main')

@section('content')
<div class="container py-4">
    @if (session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <form action="{{ route('produk.index') }}" method="GET" class="row g-2 mb-4 align-items-center">
        <div class="col-md-8">
            <input type="text" name="cari" class="form-control shadow-sm" placeholder="🔍 Cari produk berdasarkan nama atau kategori..." value="{{ request('cari') }}">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-dark shadow-sm">Cari</button>
        </div>
        <div class="col-md-2 d-grid">
            <a href="{{ route('produk.index') }}" class="btn btn-outline-dark shadow-sm">Reset</a>
        </div>
    </form>

    @if (Auth::check() && Auth::user()->role === 'a')
        <div class="mb-4 text-end">
            <a href="{{ route('produk.create') }}" class="btn btn-success shadow-sm">
                + Tambah Produk
            </a>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($produks as $item)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm hover-shadow">
                    <a href="{{ route('detail_produks.show', $item->id) }}">
                        @if ($item->foto)
                            <img src="{{ asset('upload/produk/' . $item->foto) }}" class="card-img-top rounded-top" alt="{{ $item->nama }}" style="height: 220px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x220?text=No+Image" class="card-img-top" alt="No image">
                        @endif
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">
                            <a href="{{ route('detail_produks.show', $item->id) }}" class="text-decoration-none text-dark">
                                {{ $item->nama }}
                            </a>
                        </h5>
                        <span class="badge bg-primary mb-2">{{ $item->kategori }}</span>
                        <p class="text-muted small">{{ \Illuminate\Support\Str::limit($item->deskripsi, 80, '...') }}</p>

                        <div class="mb-2">
                            <span class="fw-bold text-success fs-6">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                            <small class="text-muted"> / Tahun</small>
                        </div>

                        <p class="text-secondary small mb-2">Stok: <strong>{{ $item->stok }}</strong></p>

                        <span class="badge {{ $item->stok > 0 ? 'bg-secondary' : 'bg-danger' }} w-100 mb-3">
                            {{ $item->stok > 0 ? 'Tersedia' : 'Stok Habis' }}
                        </span>

                        @if (Auth::check() && Auth::user()->role === 'a')
                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning w-50">
                                    Edit
                                </a>
                                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="w-50">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">Hapus</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="alert alert-info text-center w-100">
                    Belum ada produk yang tersedia.
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease-in-out;
    }
</style>
@endsection