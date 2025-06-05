@extends('layout.main')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <img src="{{ asset('upload/produk/' . $produk->foto) }}" class="img-fluid rounded border" alt="{{ $produk->nama }}">
        </div>
        <div class="col-md-7">
            <h3>{{ $produk->nama }}</h3>
            <p class="text-muted">{{ $produk->kategori }}</p>
            <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
            <p><strong>Stok:</strong> {{ $produk->stok }}</p>
            <h4 class="text-danger">Rp{{ number_format($produk->harga, 0, ',', '.') }}</h4>


            <a href="{{ route('pemesanan.create', $produk->id) }}" class="btn btn-success mt-3">Beli Sekarang</a>

            <form action="{{ route('keranjang.add') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="id" value="{{ $produk->id }}">
                <input type="hidden" name="nama" value="{{ $produk->nama }}">
                <button type="submit" class="btn btn-primary mt-3">Tambah Keranjang</button>
                <input type="hidden" name="harga" value="{{ $produk->harga }}">
            </form>
        </div>
    </div>
</div>
@endsection