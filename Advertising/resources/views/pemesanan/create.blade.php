@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Buat Pemesanan Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pemesanan.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="produk_id" class="form-label">Produk</label>
            <select name="produk_id" class="form-select" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($produks as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->nama }} - Rp{{ number_format($produk->harga, 0, ',', '.') }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="lokasi_id" class="form-label">Lokasi</label>
            <select name="lokasi_id" class="form-select" required>
                <option value="">-- Pilih Lokasi --</option>
                @foreach ($lokasis as $lokasi)
                    <option value="{{ $lokasi->id }}">{{ $lokasi->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pemesan</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (Opsional)</label>
            <input type="email" name="email" class="form-control">
        </div>

          <div class="mb-3">
            <label for="telepon" class="form-label">Telepon (opsional)</label>
            <input type="text" class="form-control" name="telepon" id="telepon">
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" required>
        </div>

        <button type="submit" class="btn btn-success">Pesan Sekarang</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
