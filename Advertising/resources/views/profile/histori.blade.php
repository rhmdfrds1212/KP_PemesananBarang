@extends('layout.main')

@section('title', 'Histori Transaksi')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center text-uppercase">Histori Transaksi Anda</h2>

    @if($histori->count() > 0)
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($histori as $item)
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="fw-bold mb-0">
                        {{ $item->produk->nama ?? 'Produk Tidak Ditemukan' }}
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-3">
                        <li><i class="bi bi-geo-alt-fill"></i> <strong>Lokasi:</strong> {{ $item->lokasi->alamat ?? '-' }}</li>
                        <li><i class="bi bi-arrows-angle-expand"></i> <strong>Ukuran:</strong> {{ $item->ukuran }}</li>
                        <li><i class="bi bi-layers-fill"></i> <strong>Jumlah:</strong> {{ $item->jumlah }}</li>
                        <li><i class="bi bi-clock-history"></i> <strong>Lama Sewa:</strong> {{ $item->lama_sewa }} Bulan</li>
                        <li><i class="bi bi-cash-stack"></i> <strong>Total Harga:</strong> 
                            <span class="text-success fw-bold">
                                Rp{{ number_format($item->total_harga, 0, ',', '.') }}
                            </span>
                        </li>
                        <li>
                            <i class="bi bi-calendar-event"></i> 
                            <strong>Tanggal Pesan:</strong> {{ $item->created_at->format('d M Y') }}
                        </li>
                    </ul>

                    <div>
                        <strong>Status:</strong> 
                        @if($item->status == 'selesai')
                            <span class="badge bg-success px-3 py-2">Selesai</span>
                        @elseif($item->status == 'diproses')
                            <span class="badge bg-warning text-dark px-3 py-2">Diproses</span>
                        @elseif($item->status == 'menunggu')
                            <span class="badge bg-secondary px-3 py-2">Menunggu</span>
                        @else
                            <span class="badge bg-danger px-3 py-2">{{ ucfirst($item->status) }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info text-center mt-4">
        <strong>Anda belum memiliki histori transaksi penyewaan.</strong>
    </div>
    @endif
</div>
@endsection
