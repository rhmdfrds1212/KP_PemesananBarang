@extends('layout.main')

@section('content')
<div class="py-5" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="bg-white rounded shadow-sm p-4">
            <div class="row g-5 align-items-start">
                <div class="col-md-5">
                    <div class="border rounded overflow-hidden">
                        @if ($produk->foto)
                            <img src="{{ asset('upload/produk/' . $produk->foto) }}" class="img-fluid w-100" alt="{{ $produk->nama }}">
                        @else
                            <img src="https://via.placeholder.com/400x400?text=No+Image" class="img-fluid w-100" alt="No Image">
                        @endif
                    </div>
                </div>

                <div class="col-md-7">
                    <h2 class="fw-bold">{{ $produk->nama }}</h2>
                    <span class="badge bg-primary mb-3">{{ $produk->kategori }}</span>

                    <h4 class="text-danger fw-semibold mb-3">Rp{{ number_format($produk->harga, 0, ',', '.') }}</h4>

                    <p><i class="bi bi-info-circle-fill text-secondary me-2"></i><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
                    <p><i class="bi bi-box-seam text-secondary me-2"></i><strong>Stok Tersedia:</strong> {{ $produk->stok }}</p>

                    <div class="d-flex gap-3 mt-4 flex-wrap">
                        <a href="{{ route('pemesanan.create', $produk->id) }}" class="btn btn-success btn-lg px-4 shadow-sm">Beli Sekarang</a>

                        <form action="{{ route('keranjang.add') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="id" value="{{ $produk->id }}">
                            <input type="hidden" name="nama" value="{{ $produk->nama }}">
                            <input type="hidden" name="harga" value="{{ $produk->harga }}">
                            <button type="submit" class="btn btn-outline-primary btn-lg px-4 shadow-sm">+ Keranjang</button>
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
        transform: scale(1.02);
        transition: 0.2s ease-in-out;
    }
</style>
@endsection