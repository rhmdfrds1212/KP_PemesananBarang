@extends('layout.main')

@section('content')

<style>
    .produk-section {
        background-color: #fff;
        padding: 60px 0;
    }
    .produk-title {
        text-align: center;
        font-weight: bold;
        margin-bottom: 30px;
    }
    .kategori-nav {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    .kategori-nav a {
        padding: 8px 20px;
        border-radius: 30px;
        background-color: #f0f0f0;
        color: #333;
        text-decoration: none;
        font-weight: 600;
        border: 2px solid transparent;
        transition: all 0.3s;
    }
    .kategori-nav a.active,
    .kategori-nav a:hover {
        background-color: #6ce368;
        color: #000;
        border-color: #6ce368;
    }
    .card-produk {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: all 0.3s;
        height: 100%;
    }
    .card-produk:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(0,0,0,0.15);
    }
    .card-img-top {
        border-radius: 10px 10px 0 0;
        height: 220px;
        object-fit: cover;
    }
    .btn-action {
        width: 48%;
    }
</style>

<div class="produk-section">
    <div class="container">

        {{-- Tombol Tambah (Hanya Admin) --}}
        @if (Auth::check() && Auth::user()->role === 'a')
        <div class="text-end mb-3">
            <a href="{{ route('produk.create') }}" class="btn btn-success">
                + Tambah Produk
            </a>
        </div>
        @endif

        {{-- Form Pencarian --}}
        <form action="{{ route('produk.index') }}" method="GET" class="row g-2 mb-4 justify-content-center">
            <div class="col-md-6">
                <input type="text" name="cari" class="form-control" placeholder="🔍 Cari produk..." value="{{ request('cari') }}">
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-dark">Cari</button>
            </div>
            <div class="col-md-2 d-grid">
                <a href="{{ route('produk.index') }}" class="btn btn-outline-dark">Reset</a>
            </div>
        </form>

        {{-- Daftar Produk --}}
        <div class="row g-4">
            @forelse ($produks as $produk)
            <div class="col-md-4 col-lg-3">
                <div class="card card-produk h-100">
                    @if ($produk->foto)
                        <img src="{{ asset('upload/produk/' . $produk->foto) }}" class="card-img-top" alt="{{ $produk->nama }}">
                    @else
                        <img src="https://via.placeholder.com/400x220?text=No+Image" class="card-img-top" alt="No Image">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ strtoupper($produk->nama) }}</h5>
                        <span class="badge bg-primary mb-2">{{ $produk->kategori }}</span>
                        <p class="text-muted small">{{ \Illuminate\Support\Str::limit($produk->deskripsi, 60, '...') }}</p>
                        <p class="text-secondary small mb-2">Stok: <strong>{{ $produk->stok > 0 ? 'Tersedia' : 'Habis' }}</strong></p>

                        <div class="mt-auto">
                            <a href="{{ route('detail_produks.show', $produk->id) }}" class="btn btn-warning w-100 mb-2">
                                Lihat Detail
                            </a>

                            @if (Auth::check() && Auth::user()->role === 'a')
                            <div class="d-flex gap-2">
                                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-primary btn-sm btn-action">
                                    Edit
                                </a>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="btn-action">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info text-center">
                Produk tidak ditemukan.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
