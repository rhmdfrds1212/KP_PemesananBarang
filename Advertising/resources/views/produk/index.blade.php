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

    <a href="{{ route('produk.create') }}" class="btn btn btn-success mb-4">+ Tambah Produk</a>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($produks as $item)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if ($item->foto)
                        <a href="{{ route('detailProduk.show', $item->id) }}">
                            <img src="{{ asset('upload/produk/' . $item->foto) }}" class="card-img-top" alt="{{ $item->nama }}" style="height: 250px; object-fit: cover;">
                        </a>
                    @else
                        <img src="https://via.placeholder.com/250x250?text=No+Image" class="card-img-top" alt="No image">
                    @endif
                    <div class="card-body d-flex flex-column fs-5">
                        <a href="{{ route('detailProduk.show', $item->id) }}" class="text-decoration-none text-dark">
                            <h5 class="card-title fs-4">{{ $item->nama }}</h5>
                        </a>
                        <p class="card-text mb-2">{{ $item->deskripsi }}</p>
                        <p class="card-text text-muted mb-1">{{ $item->kategori }}</p>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <p class="card-text fw-bold mb-0">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                            <p class="card-text text-secondary mb-0">Stok: {{ $item->stok }}</p>
                        </div>
                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning w-100 mb-2">Edit</a>
                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger w-100">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <p class="text-center fs-4">Belum ada produk tersedia.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
