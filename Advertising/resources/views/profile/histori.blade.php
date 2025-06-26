@extends('layout.main')

@section('title', 'Histori Transaksi')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4">Histori Transaksi</h2>

    @if ($histori->count() > 0)
        @foreach ($histori as $item)
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->produk->nama ?? 'Produk tidak tersedia' }}</h5>
                    <p class="mb-1"><strong>Lokasi:</strong> {{ $item->lokasi->alamat ?? '-' }}</p>
                    <p class="mb-1"><strong>Jumlah:</strong> {{ $item->jumlah }}</p>
                    <p class="mb-1"><strong>Tanggal Pesan:</strong> {{ $item->created_at->format('d-m-Y') }}</p>
                    <p class="mb-1"><strong>Total Harga:</strong> Rp{{ number_format($item->total_harga, 0, ',', '.') }}</p>
                    <p class="mb-1"><strong>Status:</strong> 
                        @if($item->status == 'selesai')
                            <span class="badge bg-success">Selesai</span>
                        @elseif($item->status == 'proses')
                            <span class="badge bg-warning text-dark">Proses</span>
                        @else
                            <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                        @endif
                    </p>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info">
            Anda belum memiliki histori transaksi.
        </div>
    @endif
</div>
@endsection
