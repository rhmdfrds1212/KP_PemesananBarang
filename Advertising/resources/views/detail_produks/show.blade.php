@extends('layout.main')

@section('content')
<div class="py-5" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="bg-white rounded shadow-sm p-4">
            <div class="row g-4 align-items-start">
                <div class="col-md-5">
                    <div class="border rounded overflow-hidden shadow-sm">
                        @if ($produk->foto)
                            <img src="{{ asset('upload/produk/' . $produk->foto) }}" class="img-fluid w-100" alt="{{ $produk->nama }}">
                        @else
                            <img src="https://via.placeholder.com/400x400?text=No+Image" class="img-fluid w-100" alt="No Image">
                        @endif
                    </div>
                </div>

                <div class="col-md-7">
                    <h2 class="fw-bold text-dark">{{ $produk->nama }}</h2>
                    <span class="badge bg-primary fs-6 mb-3">{{ $produk->kategori }}</span>

                    <h4 class="text-success fw-semibold mb-3">
                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                        <small class="text-muted fs-6">/ Tahun</small>
                    </h4>

                    <p class="text-secondary mb-2" style="word-break: break-word;">
                        <span class="d-inline-flex align-items-center">
                            <i class="bi bi-info-circle-fill me-2 text-primary"></i>
                            <strong>Deskripsi:</strong>
                        </span><br>
                        {{ $produk->deskripsi }}
                    </p>

                    <p class="text-secondary mb-4">
                        <i class="bi bi-box-seam me-2 text-success"></i>
                        <strong>Produk Tersedia:</strong> {{ $produk->stok }}
                    </p>

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a href="{{ route('pemesanan.create', $produk->id) }}" class="btn btn-success btn-lg px-4 shadow-sm">
                            <i class="bi bi-cart-plus me-2"></i>Beli Sekarang
                        </a>

                        <form action="{{ route('keranjang.add') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $produk->id }}">
                            <input type="hidden" name="nama" value="{{ $produk->nama }}">
                            <input type="hidden" name="harga" value="{{ $produk->harga }}">
                            <button type="submit" class="btn btn-outline-primary btn-lg px-4 shadow-sm">
                                <i class="bi bi-bag-plus me-2"></i>+ Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
    .btn-lg:hover {
        transform: scale(1.03);
        transition: all 0.2s ease-in-out;
    }

    .card-img-top, .img-fluid {
        border-radius: 8px;
    }

    h2, h4 {
        line-height: 1.4;
    }
    .deskripsi-box {
        min-height: 100px;
        word-wrap: break-word;  
        overflow-wrap: break-word;  
        white-space: pre-line;      
}
</style>
@endsection