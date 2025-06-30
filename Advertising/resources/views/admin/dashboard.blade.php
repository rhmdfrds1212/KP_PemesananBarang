@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
<div class="container mt-5">
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center">
                    <i class="bi bi-cash-stack fs-1 text-success"></i>
                    <h5 class="fw-bold mt-2">Total Pendapatan</h5>
                    <h3 class="text-success">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center">
                    <i class="bi bi-bag-check fs-1 text-primary"></i>
                    <h5 class="fw-bold mt-2">Total Pemesanan</h5>
                    <h3>{{ $totalPemesanan }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center">
                    <i class="bi bi-box-seam fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-2">Total Produk</h5>
                    <h3>{{ $totalProduk }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center">
                    <i class="bi bi-geo-alt fs-1 text-danger"></i>
                    <h5 class="fw-bold mt-2">Total Lokasi</h5>
                    <h3>{{ $totalLokasi }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body text-center">
                    <i class="bi bi-people fs-1 text-secondary"></i>
                    <h5 class="fw-bold mt-2">Total Pelanggan</h5>
                    <h3>{{ $totalPelanggan }}</h3>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection