@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Pemesanan</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Produk</label>
            <input type="text" class="form-control" value="{{ $produkTerpilih->nama }}" readonly>
            <input type="hidden" name="produk_id" value="{{ $produkTerpilih->id }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <select name="lokasi_id" class="form-select" required>
                <option value="">-- Pilih Lokasi --</option>
                @foreach ($lokasis as $lokasi)
                    <option value="{{ $lokasi->id }}" {{ $pemesanan->lokasi_id == $lokasi->id ? 'selected' : '' }}>
                        {{ $lokasi->alamat }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Pemesan</label>
            <input type="text" name="nama" class="form-control" value="{{ $pemesanan->nama }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $pemesanan->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="telepon" class="form-control" value="{{ $pemesanan->telepon }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Ukuran</label>
            <input type="text" name="ukuran" class="form-control" value="{{ $pemesanan->ukuran }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" min="1" value="{{ $pemesanan->jumlah }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Lama Sewa (Bulan)</label>
            <input type="number" name="lama_sewa" class="form-control" min="1" value="{{ $pemesanan->lama_sewa }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="menunggu" {{ $pemesanan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diproses" {{ $pemesanan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ $pemesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Pemesanan</button>
        <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection