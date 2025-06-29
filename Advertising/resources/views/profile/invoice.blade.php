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

    @if (Auth::user()->role === 'a')
        <h2 class="fw-bold mb-4">Invoice Seluruh Pengguna</h2>
    @else
        <h2 class="fw-bold mb-4">Invoice Saya</h2>
    @endif

    @forelse($invoices as $invoice)
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            {{-- Header --}}
            <div class="d-flex justify-content-between">
                <div>
                    <h4 class="fw-bold">INVOICE</h4>
                    <p>No Invoice: <strong>{{ $invoice->id }}</strong></p>
                    <p>Tanggal: {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}</p>
                </div>
                <div class="text-end">
                    <h5 class="fw-bold">CV. Ramanisa White Media Promosindo</h5>
                    <p>Jl. Contoh Alamat No. 123, Kota</p>
                    <p>Email: rawhite.adv@gmail.com</p>
                    <p>Telepon: 0812-3456-7890</p>
                </div>
            </div>

            <hr>

            {{-- Informasi Pelanggan --}}
            <h6>Tagihan Kepada:</h6>
            <p><strong>{{ $invoice->pemesanan->nama }}</strong></p>
            <p>Email: {{ $invoice->pemesanan->email }}</p>
            <p>Telepon: {{ $invoice->pemesanan->telepon }}</p>

            {{-- Jika Admin, tampilkan info user --}}
            @if(Auth::user()->role === 'a')
                <p><strong>Nama Pelanggan:</strong> {{ $invoice->pemesanan->nama }}</p>
                <p><strong>Email Pelanggan:</strong> {{ $invoice->pemesanan->email }}</p>
            @endif

            {{-- Detail Pemesanan --}}
            <table class="table table-bordered mt-3">
                <tr>
                    <th>Produk</th>
                    <td>{{ $invoice->pemesanan->produk->nama }}</td>
                </tr>
                <tr>
                    <th>Ukuran</th>
                    <td>{{ $invoice->pemesanan->ukuran }}</td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>{{ $invoice->pemesanan->lokasi->alamat }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>{{ $invoice->pemesanan->jumlah }}</td>
                </tr>
                <tr>
                    <th>Lama Sewa</th>
                    <td>{{ $invoice->pemesanan->lama_sewa }} Bulan</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>Rp{{ number_format($invoice->pemesanan->total_harga, 0, ',', '.') }}</td>
                </tr>
            </table>

            {{-- Pembayaran --}}
            <h6 class="mt-3">Metode Pembayaran:</h6>
            <p>{{ strtoupper($invoice->metode) }}</p>

            {{-- Tampilkan QR atau Nomor Rekening --}}
            @if($invoice->metode == 'qris')
                <img src="{{ asset('images/qr.png') }}" alt="QRIS" width="150">
                <p>Scan untuk membayar via QRIS.</p>
            @elseif($invoice->metode == 'bca')
                <p>Transfer ke <strong>BCA</strong> 123456789 a/n CV. Ramanisa</p>
            @elseif($invoice->metode == 'bri')
                <p>Transfer ke <strong>BRI</strong> 987654321 a/n CV. Ramanisa</p>
            @endif

            {{-- Status --}}
            <p class="mt-2">
                <strong>Status Pembayaran:</strong> 
                <span class="badge bg-{{ $invoice->status_verifikasi == 'diterima' ? 'success' : ($invoice->status_verifikasi == 'pending' ? 'warning' : 'danger') }}">
                    {{ ucfirst($invoice->status_verifikasi) }}
                </span>
            </p>

            {{-- Bukti Pembayaran --}}
            @if($invoice->bukti_pembayaran)
                <p class="fw-bold">Bukti Pembayaran:</p>
                <img src="{{ asset('storage/' . $invoice->bukti_pembayaran) }}" width="200">
            @endif

            {{-- Ringkasan Total --}}
            <div class="text-end mt-3">
                <h5>Subtotal:</h5>
                <p>Rp{{ number_format($invoice->pemesanan->total_harga) }}</p>

                <h4 class="fw-bold">Total Bayar:</h4>
                <h4 class="fw-bold text-success">
                    Rp{{ number_format($invoice->pemesanan->total_harga) }}
                </h4>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-info text-center">
        @if(Auth::user()->role === 'a')
            Belum ada invoice dari pelanggan.
        @else
            Anda belum memiliki invoice.
        @endif
    </div>
    @endforelse

</div>
@endsection