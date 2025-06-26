@extends('layout.main')

@section('title', 'Riwayat Pembelian Pelanggan')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Riwayat Pembelian Pelanggan</h2>

    @if($riwayat->count() > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($riwayat as $item)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">{{ $item->produk?->nama ?? 'Produk tidak tersedia' }}</h5>

                        <p><strong>Nama Pemesan:</strong> {{ $item->nama }}</p>
                        <p><strong>Email:</strong> {{ $item->email }}</p>
                        <p><strong>Telepon:</strong> {{ $item->telepon }}</p>
                        <p><strong>Lokasi:</strong> {{ $item->lokasi?->alamat ?? '-' }}</p>
                        <p><strong>Ukuran:</strong> {{ $item->ukuran }}</p>
                        <p><strong>Jumlah:</strong> {{ $item->jumlah }}</p>
                        <p><strong>Lama Sewa:</strong> {{ $item->lama_sewa }} hari</p>
                        <p><strong>Harga Sewa:</strong> Rp{{ number_format($item->harga_sewa, 0, ',', '.') }}</p>
                        <p><strong>Total Harga:</strong> Rp{{ number_format($item->total_harga, 0, ',', '.') }}</p>
                        <p><strong>Tanggal Pesan:</strong> {{ $item->created_at->format('d-m-Y') }}</p>

                        <div class="mb-3">
                            <strong>Status:</strong> 
                            @if($item->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($item->status == 'proses')
                                <span class="badge bg-warning text-dark">Proses</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                            @endif
                        </div>

                        {{-- Form Update Status --}}
                        <form action="{{ route('riwayat.update', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="input-group">
                                <select name="status" class="form-select" required>
                                    <option value="proses" {{ $item->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="dibatalkan" {{ $item->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center">
            Belum ada transaksi dari pelanggan.
        </div>
    @endif
</div>
@endsection
