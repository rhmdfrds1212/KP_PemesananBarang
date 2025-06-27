@extends('layout.main')

@section('title', 'Histori Transaksi')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Histori Transaksi</h3>

    @if($histori->count() > 0)
        @foreach($histori as $item)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->produk->nama ?? 'Produk Tidak Ditemukan' }}</h5>
                    <p>
                        <strong>Lokasi:</strong> {{ $item->lokasi->alamat ?? '-' }}<br>
                        <strong>Ukuran:</strong> {{ $item->ukuran }}<br>
                        <strong>Jumlah:</strong> {{ $item->jumlah }}<br>
                        <strong>Lama Sewa:</strong> {{ $item->lama_sewa }} hari<br>
                        <strong>Total Harga:</strong> Rp{{ number_format($item->total_harga) }}<br>
                        <strong>Status:</strong> 
                        <span class="badge 
                            {{ $item->status == 'selesai' ? 'bg-success' : 
                                ($item->status == 'diproses' ? 'bg-warning' : 
                                ($item->status == 'menunggu' ? 'bg-secondary' : 'bg-danger')) }}">
                            {{ ucfirst($item->status) }}
                        </span><br>
                        <small class="text-muted">Dipesan pada {{ $item->created_at->format('d M Y') }}</small>
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