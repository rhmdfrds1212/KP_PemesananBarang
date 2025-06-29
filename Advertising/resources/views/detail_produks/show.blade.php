@extends('layout.main')

@section('content')

<style>
    .produk-detail {
        background-color: rgba(255, 219, 100, 0.97);
        padding: 30px;
        border-radius: 10px;
    }

    .thumbnail {
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .thumbnail:hover {
        transform: scale(1.05);
        opacity: 0.8;
    }
</style>

<div class="container py-5">
    <div class="row g-4 align-items-center">
        <div class="col-md-6">

            <img id="mainImage" 
                 src="{{ asset('upload/produk/' . $produk->foto) }}" 
                 class="img-fluid rounded shadow mb-3" 
                 alt="{{ $produk->nama }}">

            <div class="d-flex gap-3 flex-wrap">
                <img src="{{ asset('upload/produk/' . $produk->foto) }}" 
                     class="rounded shadow-sm thumbnail" 
                     alt="Foto Utama" 
                     style="width: 100px; height: 80px; object-fit: cover;"
                     onclick="changeImage('{{ asset('upload/produk/' . $produk->foto) }}')">

                @forelse ($detail_foto as $foto)
                    <img src="{{ asset('upload/detail_produk/' . $foto->foto) }}" 
                         class="rounded shadow-sm thumbnail" 
                         alt="Foto Tambahan" 
                         style="width: 100px; height: 80px; object-fit: cover;"
                         onclick="changeImage('{{ asset('upload/detail_produk/' . $foto->foto) }}')">
                @empty
                    <p class="text-muted">Belum ada foto tambahan.</p>
                @endforelse
            </div>
        </div>

        <div class="col-md-6 produk-detail">
            <h2 class="fw-bold">{{ strtoupper($produk->nama) }}</h2>
            <p><strong>Kategori:</strong> {{ $produk->kategori }}</p>
            <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
            <p><strong>Harga:</strong> Lihat harga berdasarkan lokasi pada saat pemesanan</p>
            <p><strong>Stok:</strong> {{ $produk->stok > 0 ? 'Tersedia' : 'Habis' }}</p>
            <p><strong>Ukuran Tersedia:</strong></p>
            <ul>
                @if (strtolower($produk->kategori) == 'baliho')
                    <li>4 x 6 M Vertical</li>
                    <li>8 x 4 M Horizontal</li>
                @elseif (strtolower($produk->kategori) == 'videotron')
                    <li>2 x 4 M Horizontal</li>
                    <li>4 x 6 M Vertical</li>
                @elseif (strtolower($produk->kategori) == 'billboard')
                    <li>5 x 10 M Vertical</li>
                    <li>6 x 12 M Vertical</li>
                @else
                    <li>Custom sesuai kebutuhan</li>
                @endif
            </ul>

            <a href="{{ route('pemesanan.create', $produk->id) }}" class="btn btn-success">
                Pesan Sekarang
            </a>
        </div>
    </div>
</div>

<script>
    function changeImage(imageUrl) {
        document.getElementById('mainImage').src = imageUrl;
    }
</script>

@endsection