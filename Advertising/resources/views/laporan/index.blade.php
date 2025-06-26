<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 14px;
            background-color: #f8f9fa;
            color: #212529;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table thead {
            background-color: #e9ecef;
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

        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
<div class="container bg-white mt-4 p-4 shadow rounded">

    {{-- Header --}}
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

    {{-- Tabel Laporan --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Nama Pembeli</th>
                <th>Lokasi</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pembayaran?->pemesanan?->produk?->nama ?? '-' }}</td>
                    <td>{{ $item->pembayaran?->pemesanan?->nama ?? '-' }}</td>
                    <td>{{ $item->pembayaran?->pemesanan?->lokasi?->alamat ?? '-' }}</td>
                    <td>{{ $item->pembayaran?->pemesanan?->jumlah ?? '-' }}</td>
                    <td>{{ $item->pembayaran?->pemesanan?->created_at?->format('d-m-Y') ?? '-' }}</td>
                    <td>Rp{{ number_format($item->pembayaran?->pemesanan?->total_harga ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
</body>
</html>
