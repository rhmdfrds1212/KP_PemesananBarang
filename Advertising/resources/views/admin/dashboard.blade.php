@extends('layout.main')

@section('title', 'Dashboard')

@section('content')

 {{-- Grafik --}}
    <div class="card mt-5 shadow-sm border-0 rounded-4">
        <div class="card-body">
            <h4 class="fw-bold mb-4 text-center">Grafik Pemesanan Per Bulan</h4>
            <canvas id="chartPemesanan" height="100"></canvas>
        </div>
    </div>
</div>

{{-- CDN Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('chartPemesanan').getContext('2d');

    const chartPemesanan = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: {!! json_encode($chartData) !!},
                backgroundColor: 'rgba(25, 135, 84, 0.7)',
                borderColor: 'rgba(25, 135, 84, 1)',
                borderWidth: 2,
                borderRadius: 5,
                barThickness: 40,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
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
@endsection