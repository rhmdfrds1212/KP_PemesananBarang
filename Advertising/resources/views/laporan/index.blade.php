@extends('layout.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }

        body {
            font-size: 14px;
        }

        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Laporan Data Transaksi</h4>
        <button onclick="window.print()" class="btn btn-primary no-print">Cetak</button>
    </div>

    <table class="table table-bordered">
        <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Jumlah</th>
            <th>Tanggal</th>
            <th>Total Harga</th>
        </tr>
        </thead>
        <tbody>
        @foreach($laporan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
@endsection