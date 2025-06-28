@extends('layout.main')

@section('title', 'Invoice Saya')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4">Invoice Pemesanan</h2>

    @forelse($invoice as $item)
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold">{{ $item->produk->nama }}</h5>
                <p>Lokasi: {{ $item->lokasi->alamat }}</p>
                <p>Ukuran: {{ $item->ukuran }}</p>
                <p>Jumlah: {{ $item->jumlah }}</p>
                <p>Lama Sewa: {{ $item->lama_sewa }} Tahun</p>
                <p>Total Harga: <strong>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</strong></p>
                <p>Status: 
                    <span class="badge bg-{{ $item->status == 'selesai' ? 'success' : 'warning' }}">
                        {{ ucfirst($item->status) }}
                    </span>
                </p>
            </div>
        </div>
    @empty
        <p class="text-muted">Belum ada invoice.</p>
    @endforelse
</div>
@endsection