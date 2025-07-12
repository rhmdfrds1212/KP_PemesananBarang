@extends('layout.main')

@section('content')

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        transition: all 0.3s ease-in-out;
    }
</style>

<div class="container mt-4">
    <h2 class="mb-4">Daftar Pemesanan</h2>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($pemesanans->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada pemesanan.
        </div>
    @endif

    <div class="row g-4">
        @foreach($pemesanans as $pemesanan)
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold mb-2">
                        {{ $pemesanan->produk->nama ?? '-' }}
                    </h5>
                    <p class="mb-1"><strong>Lokasi:</strong> {{ $pemesanan->lokasi->alamat ?? '-' }}</p>
                    <p class="mb-1"><strong>Ukuran:</strong> {{ $pemesanan->ukuran }}</p>
                    <p class="mb-1"><strong>Jumlah:</strong> {{ $pemesanan->jumlah }}</p>
                    <p class="mb-1"><strong>Total:</strong> Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</p>

                    <p class="mb-1">
                        <strong>Status:</strong> 
                        <span class="badge 
                            @if($pemesanan->status == 'menunggu') bg-secondary 
                            @elseif($pemesanan->status == 'diproses') bg-warning 
                            @elseif($pemesanan->status == 'selesai') bg-success 
                            @else bg-dark @endif">
                            {{ ucfirst($pemesanan->status) }}
                        </span>
                    </p>

                    <div class="mt-auto d-flex gap-2">
                        @php
                            $isTerverifikasi = $pemesanan->pembayaran && $pemesanan->pembayaran->status_verifikasi === 'diterima';
                        @endphp

                        @if(!$isTerverifikasi && !in_array($pemesanan->status, ['diproses', 'selesai']))
                            <a href="{{ route('pemesanan.edit', $pemesanan->id) }}" 
                            class="btn btn-sm btn-warning w-50">
                                Edit
                            </a>
                            <form action="{{ route('pemesanan.destroy', $pemesanan->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin membatalkan pemesanan ini?')" class="w-50">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger w-100">Batalkan</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
