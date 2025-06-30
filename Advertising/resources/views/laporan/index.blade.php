<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-size: 14px;
            color: #212529;
        }
        .laporan-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .report-header {
            border-bottom: 2px solid #dee2e6;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .report-title {
            font-size: 20px;
            font-weight: bold;
        }
        .block {
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fafafa;
        }
        .block-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }
        .label {
            width: 150px;
            display: inline-block;
            font-weight: 600;
        }
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<div class="container laporan-container mt-4">

    <div class="report-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="50">
            <div class="report-title">Laporan Data Transaksi</div>
        </div>
        <div class="no-print">
            <a href="{{ route('home.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            <button onclick="window.print()" class="btn btn-primary btn-sm">Cetak</button>
        </div>
    </div>

    @forelse ($laporan as $item)
        <div class="block">
            <div class="block-title">Transaksi ke-{{ $loop->iteration }}</div>

            <div><span class="label">Nama Produk:</span> {{ $item->pembayaran?->pemesanan?->produk?->nama ?? '-' }}</div>
            <div><span class="label">Nama Pembeli:</span> {{ $item->pembayaran?->pemesanan?->nama ?? '-' }}</div>
            <div><span class="label">Lokasi:</span> {{ $item->pembayaran?->pemesanan?->lokasi?->alamat ?? '-' }}</div>
            <div><span class="label">Jumlah:</span> {{ $item->pembayaran?->pemesanan?->jumlah ?? '-' }}</div>
            <div><span class="label">Tanggal:</span> {{ $item->pembayaran?->pemesanan?->created_at?->format('d-m-Y') ?? '-' }}</div>
            <div><span class="label">Total Harga:</span> 
                <strong>Rp{{ number_format($item->pembayaran?->pemesanan?->total_harga ?? 0, 0, ',', '.') }}</strong>
            </div>
        </div>
    @empty
        <div class="alert alert-warning text-center">
            Tidak ada data transaksi tersedia.
        </div>
    @endforelse

</div>
</body>
</html>