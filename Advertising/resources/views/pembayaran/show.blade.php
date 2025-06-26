@extends('layout.main')

@section('content')
<div class="py-5" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="bg-white p-4 rounded shadow-sm">
            <h3 class="mb-4">Pembayaran Pemesanan</h3>

            <div class="mb-4">
                <h5 class="mb-3">Detail Pemesanan</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nama Produk:</strong> {{ $pemesanan->produk->nama }}</li>
                    <li class="list-group-item"><strong>Ukuran:</strong> {{ $pemesanan->ukuran }}</li>
                    <li class="list-group-item"><strong>Jumlah:</strong> {{ $pemesanan->jumlah }}</li>
                    <li class="list-group-item"><strong>Lama Sewa:</strong> {{ $pemesanan->lama_sewa }} Tahun</li>
                    <li class="list-group-item"><strong>Lokasi:</strong> {{ $pemesanan->lokasi->alamat }}</li>
                    <li class="list-group-item"><strong>Total Harga:</strong> <span class="text-success fw-semibold">Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span></li>
                </ul>
            </div>

            @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Terjadi kesalahan:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


            <form action="{{ route('pembayaran.store', $pemesanan->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label">Pilih Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                        <option value="transfer_bank">-- Pilih Metode --</option>
                        <option value="bca">BCA</option>
                        <option value="bri">BRI</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Tambahan (Opsional)</label>
                        <textarea name="catatan" class="form-control" rows="3" placeholder="Tulis catatan jika ada..."></textarea>
                </div>

                    <button type="submit" class="btn btn-success">Konfirmasi & Bayar</button>
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
