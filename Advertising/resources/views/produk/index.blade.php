@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Produk Kami</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('produk.create') }}" class="btn btn-primary mb-4">+ Tambah Produk</a>

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


    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse ($produk as $item)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if ($item->foto)
                        <img src="{{ asset('upload/produk/' . $item->foto) }}" class="card-img-top" alt="{{ $item->nama }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="https://via.placeholder.com/200x200?text=No+Image" class="card-img-top" alt="No image">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->nama }}</h5>
                        <p class="card-text text-muted mb-1">{{ $item->kategori }}</p>
                        <p class="card-text fw-bold mb-1">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                        <p class="card-text text-secondary">Stok: {{ $item->stok }}</p>
                        <div class="mt-auto">
                            <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-sm btn-warning w-100 mb-2">Edit</a>
                            <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger w-100">Hapus</button>
                            </form>
                            <a href="{{ route('produk.beli', $item->id) }}" class="btn btn-success w-100 mb-2">Beli</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <p class="text-center">Belum ada produk tersedia.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
