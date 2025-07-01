@extends('layout.main')

@section('title', 'Edit Lokasi')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Edit Lokasi</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('lokasi.update', $lokasi->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mb-3">
                    <label for="alamat" class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat', $lokasi->alamat) }}</textarea>
                </div>

                <div class="mt-3">
                    <label for="status" class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="tersedia" {{ old('status', $lokasi->status) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="tersewa" {{ old('status', $lokasi->status) == 'tersewa' ? 'selected' : '' }}>Tersewa</option>
                    </select>
                </div>

                <div class="mt-3">
                    <label for="produk_nama" class="form-label fw-semibold">Jenis Produk</label>
                    <input type="text" name="produk_nama" class="form-control"
                        value="{{ old('produk_nama', $lokasi->produk_nama) }}" required>
                </div>

                <div class="mt-3">
                    <label for="ukuran" class="form-label fw-semibold">Ukuran</label>
                    <input type="text" name="ukuran" class="form-control"
                        value="{{ old('ukuran', $lokasi->ukuran) }}" required>
                </div>

                <div class="mt-3">
                    <label for="harga" class="form-label fw-semibold">Harga Sewa (Per Bulan)</label>
                    <input type="number" name="harga" class="form-control"
                        value="{{ old('harga', $lokasi->harga) }}" required>
                    <small class="text-muted">Masukkan harga sewa lokasi per bulan (tanpa titik/koma).</small>
                </div>

                <div class="mt-3">
                    <label for="foto" class="form-label fw-semibold">Foto Lokasi</label>
                    <input type="file" name="foto" class="form-control">
                    @if($lokasi->foto)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $lokasi->foto) }}" 
                                alt="Foto Lokasi" style="max-height: 200px; border-radius: 5px;">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection