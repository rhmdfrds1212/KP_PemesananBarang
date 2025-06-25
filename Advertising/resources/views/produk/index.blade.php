@extends('layout.main')

@section('content')
<div class="container mt-4">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('produk.index') }}" method="GET" class="row mb-4 g-2 align-items-center">
        <div class="col-md-8">
            <input type="text" name="cari" class="form-control" placeholder="Cari produk berdasarkan nama atau kategori..." value="{{ request('cari') }}">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </div>
        <div class="col-md-2 d-grid">
            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>

    {{-- Tombol Tambah Produk hanya untuk Admin --}}
    @if (Auth::check() && Auth::user()->role === 'a')
        <a href="{{ route('produk.create') }}" class="btn btn-success mb-4">+ Tambah Produk</a>
    @endif

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($produks as $item)
            <div class="col">
                <div class="card h-100 shadow-sm border-0 hover-shadow">
                    <a href="{{ route('detail_produks.show', $item->id) }}">
                        @if ($item->foto)
                            <img src="{{ asset('upload/produk/' . $item->foto) }}" class="card-img-top rounded-top" alt="{{ $item->nama }}" style="height: 250px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/250x250?text=No+Image" class="card-img-top" alt="No image">
                        @endif
                    </a>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title mb-1">
                            <a href="{{ route('detail_produks.show', $item->id) }}" class="text-decoration-none text-dark">
                                {{ $item->nama }}
                            </a>
                        </h5>
                        <span class="badge bg-primary mb-2">{{ $item->kategori }}</span>
                        <p class="text-muted small mb-2">{{ \Illuminate\Support\Str::limit($item->deskripsi, 100, '...') }}</p>
                        <p class="fw-bold text-success mb-1">Rp{{ number_format($item->harga, 0, ',', '.') }} <small class="text-muted"> / Tahun </small></p>
                        <p class="text-secondary small mb-3">Stok: <strong>{{ $item->stok }}</strong></p>

                        @if ($item->stok > 0)
                            <span class="badge bg-success w-100">Tersedia</span>
                        @else
                            <span class="badge bg-secondary w-100">Stok Habis</span>
                        @endif

                        {{-- Tombol Edit dan Hapus hanya untuk Admin --}}
                        @if (Auth::check() && Auth::user()->role === 'a')
                            <div class="mt-auto d-flex gap-2">
                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning w-50">Edit</a>
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
                <p class="text-center fs-5">Belum ada produk tersedia.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .hover-shadow:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        transition: 0.3s ease;
    }
</style>
@endsection
