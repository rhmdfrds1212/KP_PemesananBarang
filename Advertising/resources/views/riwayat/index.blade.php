@extends('layout.main')

@section('title', 'Riwayat Penyewaan')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center text-uppercase">Riwayat Penyewaan Pelanggan</h2>
    <div class="mb-4">
        <form action="{{ route('pemesanan.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Cari nama, email, lokasi atau produk..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-success">Cari</button>
            <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Reset</a>
        </form>
    </div>

    @if($riwayat->count() > 0)
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($riwayat as $item)
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-light border-bottom">
                    <h5 class="fw-bold mb-0">{{ $item->produk?->nama ?? 'Produk Tidak Tersedia' }}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-4">
                        <li><strong>Nama Pemesan:</strong> {{ $item->nama }}</li>
                        <li><strong>Email:</strong> {{ $item->email }}</li>
                        <li><strong>Telepon:</strong> {{ $item->telepon }}</li>
                        <li><strong>Lokasi:</strong> {{ $item->lokasi?->alamat ?? '-' }}</li>
                        <li><strong>Ukuran:</strong> {{ $item->ukuran }}</li>
                        <li><strong>Jumlah:</strong> {{ $item->jumlah }}</li>
                        <li><strong>Lama Sewa:</strong> {{ $item->lama_sewa }} bulan</li>
                        <li><strong>Harga Sewa:</strong> Rp{{ number_format($item->harga_sewa, 0, ',', '.') }}</li>
                        <li><strong>Total Harga:</strong> <span class="text-success fw-bold">Rp{{ number_format($item->total_harga, 0, ',', '.') }}</span></li>
                        <li><strong>Tanggal Pesan:</strong> {{ $item->created_at->format('d-m-Y') }}</li>
                    </ul>

                    <div class="mb-3">
                        <strong>Status:</strong>
                        @if($item->status == 'selesai')
                            <span class="badge bg-success px-3 py-2">Selesai</span>
                        @elseif($item->status == 'proses')
                            <span class="badge bg-warning text-dark px-3 py-2">Proses</span>
                        @elseif($item->status == 'dibatalkan')
                            <span class="badge bg-danger px-3 py-2">Dibatalkan</span>
                        @else
                            <span class="badge bg-secondary px-3 py-2">{{ ucfirst($item->status) }}</span>
                        @endif
                    </div>

                    <form action="{{ route('riwayat.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <select name="status" class="form-select" required>
                                <option value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="dibatalkan" {{ $item->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                            <button type="submit" class="btn btn-outline-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info text-center mt-4">
        <strong>Belum ada transaksi penyewaan dari pelanggan.</strong>
    </div>
    @endif
</div>
@endsection