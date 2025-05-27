@extends('layout.main')

@section('content')
<div class="container">
    <h2>Halaman Pembayaran</h2>
    
    <div class="card mt-4">
        <div class="card-body">
            <h4>{{ $produk->nama }}</h4>
            <p>Kategori: {{ $produk->kategori }}</p>
            <p>Harga: <strong>{{ number_format($produk->harga, 0, ',', '.') }}</strong></p>
            <p>Stok: {{ $produk->stock }}</p>

            <form action="#" method="POST" class="mb-2">
                @csrf
                <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
            </form>

            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning">Edit</a>

            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</button>
            </form>
        </div>
    </div>
</div>
@endsection
