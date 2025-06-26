@extends('layout.main')

@section('title', 'Tambah Lokasi')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-geo-alt-fill me-2"></i>Tambah Lokasi Baru</h5>
                </div>
                <div class="card-body">
                    {{-- Tampilkan error jika ada --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('lokasi.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-semibold">
                                <i class="bi bi-house-door me-1 text-success"></i> Alamat Lokasi
                            </label>
                            <textarea name="alamat" class="form-control" rows="2" required placeholder="Contoh: Jl. Soekarno Hatta No. 99">{{ old('alamat') }}</textarea>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="latitude" class="form-label fw-semibold">
                                    <i class="bi bi-compass me-1 text-primary"></i> Latitude
                                </label>
                                <input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}" placeholder="Latitude" required>
                            </div>

                            <div class="col-md-6">
                                <label for="longitude" class="form-label fw-semibold">
                                    <i class="bi bi-compass-fill me-1 text-primary"></i> Longitude
                                </label>
                                <input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}" placeholder="Longitude" required>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="status" class="form-label fw-semibold">
                                <i class="bi bi-info-circle-fill me-1 text-warning"></i> Status Lokasi
                            </label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="produk_nama" class="form-label fw-semibold">
                                <i class="bi bi-tags-fill me-1 text-info"></i> Jenis Produk
                            </label>
                            <input type="text" name="produk_nama" class="form-control" value="{{ old('produk_nama') }}" placeholder="Contoh: baliho, neonbox, billboard" required>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('lokasi.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check2-circle me-1"></i> Simpan Lokasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
