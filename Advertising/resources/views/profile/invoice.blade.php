@extends('layout.main')

@section('title', 'Invoice')

@section('content')

<style>
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        transition: all 0.3s ease-in-out;
    }
</style>

<div class="container my-5">
    <h2 class="fw-bold mb-4">
        @if (Auth::user()->role === 'a')
            Invoice Seluruh Pengguna
        @else
            Invoice Saya
        @endif
    </h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                placeholder="Cari nama pelanggan / produk / ID invoice" value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
        <div class="col-md-3">
            <button class="btn btn-success" type="submit">Cari</button>
            <a href="{{ route('profile.invoice') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="row row-cols-1 g-4">
        @forelse($invoices as $invoice)
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">

                        {{-- Header --}}
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="fw-bold">INVOICE</h4>
                                <p>No Invoice: <strong>{{ $invoice->id }}</strong></p>
                                <p>Tanggal: {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}</p>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <h5 class="fw-bold">CV. Ramanisa White Media Promosindo</h5>
                                <p>Jl. Pangeran Ratu A7-27, Jakabaring, Palembang</p>
                                <p>Email: rawhite.adv@gmail.com</p>
                                <p>Telp: 0812-3456-7890</p>
                            </div>
                        </div>

                        <hr>

                        {{-- Pelanggan --}}
                        <h6>Tagihan Kepada:</h6>
                        <p><strong>{{ $invoice->pemesanan->nama }}</strong></p>
                        <p>Email: {{ $invoice->pemesanan->email }}</p>
                        <p>Telepon: {{ $invoice->pemesanan->telepon }}</p>

                        {{-- Detail Produk --}}
                        <table class="table table-bordered mt-3">
                            <tr><th>Produk</th><td>{{ $invoice->pemesanan->produk->nama }}</td></tr>
                            <tr><th>Ukuran</th><td>{{ $invoice->pemesanan->ukuran }}</td></tr>
                            <tr><th>Lokasi</th><td>{{ $invoice->pemesanan->lokasi->alamat }}</td></tr>
                            <tr><th>Jumlah</th><td>{{ $invoice->pemesanan->jumlah }}</td></tr>
                            <tr><th>Lama Sewa</th><td>{{ $invoice->pemesanan->lama_sewa }} Bulan</td></tr>
                            <tr><th>Total Harga</th><td>Rp{{ number_format($invoice->pemesanan->total_harga, 0, ',', '.') }}</td></tr>
                        </table>

                        {{-- Metode Pembayaran --}}
                        <h6 class="mt-3">Metode Pembayaran:</h6>
                        <p>{{ strtoupper($invoice->metode) }}</p>

                        @if($invoice->metode == 'bca')
                            <p>Transfer ke <strong>BCA</strong> 3410407697 a/n Darmono</p>
                        @elseif($invoice->metode == 'mandiri')
                            <p>Transfer ke <strong>MANDIRI</strong> 113 000 203 6550 a/n Budiyanto</p>
                        @endif

                        {{-- Status --}}
                        <p class="mt-3">
                            <strong>Status Pembayaran:</strong> 
                            <span class="badge bg-{{ $invoice->status_verifikasi == 'diterima' ? 'success' : ($invoice->status_verifikasi == 'pending' ? 'warning' : 'danger') }}">
                                {{ ucfirst($invoice->status_verifikasi) }}
                            </span>
                        </p>

                        {{-- Tombol Admin --}}
                        @if(Auth::user()->role === 'a')
                            <div class="d-flex gap-2 mt-2">
                                @if($invoice->status_verifikasi === 'pending')
                                    <form action="{{ route('pembayaran.updateStatus', ['id' => $invoice->id, 'status' => 'diterima']) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button class="btn btn-success btn-sm">Terima</button>
                                    </form>
                                    <form action="{{ route('pembayaran.updateStatus', ['id' => $invoice->id, 'status' => 'ditolak']) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button class="btn btn-danger btn-sm">Tolak</button>
                                    </form>
                                @elseif($invoice->status_verifikasi === 'diterima')
                                    <form action="{{ route('pembayaran.selesai', $invoice->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-secondary btn-sm">Selesai</button>
                                    </form>
                                @endif
                            </div>
                        @endif

                        {{-- Bukti Pembayaran --}}
                        @if($invoice->bukti_pembayaran)
                            <p class="fw-bold mt-4">Bukti Pembayaran:</p>
                            <a href="{{ asset('storage/' . $invoice->bukti_pembayaran) }}" target="_blank">
                                <img src="{{ asset('storage/' . $invoice->bukti_pembayaran) }}" width="200"
                                    style="cursor: zoom-in; border: 2px solid #ddd; border-radius: 8px;">
                            </a>
                        @endif

                        {{-- Total --}}
                        <div class="text-end mt-4">
                            <h5>Subtotal:</h5>
                            <p>Rp{{ number_format($invoice->pemesanan->total_harga, 0, ',', '.') }}</p>

                            <h4 class="fw-bold">Total Bayar:</h4>
                            <h4 class="fw-bold text-success">Rp{{ number_format($invoice->pemesanan->total_harga, 0, ',', '.') }}</h4>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col">
                <div class="alert alert-info text-center">
                    @if(Auth::user()->role === 'a')
                        Belum ada invoice dari pelanggan.
                    @else
                        Anda belum memiliki invoice.
                    @endif
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection