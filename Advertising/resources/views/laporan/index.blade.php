@extends('layout.main')

@section('title', 'Laporan Data Transaksi')

@section('content')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .table-container, .table-container * {
            visibility: visible;
        }
        .table-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .filter-bar, .btn, .navbar, .footer {
            display: none !important;
        }
    }

    .filter-bar {
        background-color: #fff;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 0 5px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .table-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    .btn-download {
        background-color: #00a86b;
        color: white;
    }
    .btn-download:hover {
        background-color: #008f5a;
    }
</style>

<div class="container mt-4">
    <h4 class="fw-bold mb-3">Laporan Data Transaksi</h4>

    <div class="filter-bar">
        <form action="{{ route('laporan.index') }}" method="GET" class="row g-3 align-items-center">
            <div class="col-md-3">
                <label class="form-label">Tanggal</label>
                <input type="text" name="tanggal" class="form-control"
                    placeholder="1 Januari 2025 - 31 Januari 2026">
            </div>
            <div class="col-md-2">
                <label class="form-label">Metode Pembayaran</label>
                <select name="metode" class="form-select">
                    <option value="">Semua</option>
                    <option value="bca">BCA</option>
                    <option value="bri">BRI</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Tipe Transaksi</label>
                <select name="tipe" class="form-select">
                    <option value="">Semua</option>
                    <option value="tunai">Tunai</option>
                    <option value="non_tunai">Non Tunai</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">Cari ID Struk</label>
                <input type="text" name="id_struk" class="form-control" placeholder="Cari ID Struk">
            </div>
            <div class="col-md-3 d-flex align-items-end gap-2">
                <button class="btn btn-success">Cari</button>
                <a href="#" class="btn btn-download" onclick="window.print()">Download Laporan</a>
            </div>
        </form>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID Struk</th>
                        <th>Email</th>
                        <th>Tanggal</th>
                        <th>Metode Pembayaran</th>
                        <th>Total Tagihan (Rp)</th>
                        <th>Yang Dibayarkan (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporan as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->pembayaran?->pemesanan?->email ?? '-' }}</td>
                            <td>{{ $item->created_at?->format('d-m-Y') }}</td>
                            <td>{{ ucfirst($item->pembayaran?->metode ?? '-') }}</td>
                            <td>Rp{{ number_format($item->pembayaran?->pemesanan?->total_harga ?? 0) }}</td>
                            <td>Rp{{ number_format($item->pembayaran?->pemesanan?->total_harga ?? 0) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection