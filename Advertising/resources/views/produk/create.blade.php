@extends('layout.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="bg-white shadow-sm rounded p-4">
                <h3 class="mb-4 fw-bold text-center text-success">
                    <i class="bi me-2"></i> Tambah Produk Baru
                </h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Oops!</strong> Terdapat beberapa kesalahan:
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
                        <label for="nama" class="form-label fw-semibold">Nama Produk</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="harga" class="form-label fw-semibold">Harga Produk</label>
                            <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stok" class="form-label fw-semibold">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" value="{{ old('stok') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-semibold">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" value="{{ old('kategori') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="foto" class="form-label fw-semibold">Foto Produk</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG. Maksimal 2MB.</small>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi me-2"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- Bootstrap Icons CDN --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

{{-- Optional Styling --}}
<style>
    textarea:focus, input:focus {
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        border-color: #28a745;
    }
</style>
@endsection
