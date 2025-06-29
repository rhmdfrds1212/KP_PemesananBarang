@extends('layout.main')

@section('content')

<div class="container py-5">
    <div class="bg-white shadow rounded p-4">
        <h3 class="mb-4 fw-bold text-center">Tambah Produk</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa kembali:</strong>
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Baliho">Baliho</option>
                    <option value="Billboard">Billboard</option>
                    <option value="Videotron">Videotron</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label fw-semibold">Foto Utama Produk</label>
                <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
            </div>

            <div class="mb-3">
                <label for="foto_tambahan" class="form-label fw-semibold">Foto Tambahan (Bisa lebih dari satu)</label>
                <input type="file" class="form-control" id="foto_tambahan" name="foto_tambahan[]" accept="image/*" multiple>
                <small class="text-muted">Upload beberapa gambar untuk galeri produk.</small>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>

@endsection