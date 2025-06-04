@extends('layout.main')

@section('title', 'Tambah Lokasi')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h4 class="mb-0">Tambah Lokasi</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('lokasi.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" required>{{ old('alamat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="latitude" class="form-label">Latitude</label>
                    <input type="text" name="latitude" class="form-control" value="{{ old('latitude') }}" required>
                </div>

                <div class="mb-3">
                    <label for="longitude" class="form-label">Longitude</label>
                    <input type="text" name="longitude" class="form-control" value="{{ old('longitude') }}" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="tidak tersedia" {{ old('status') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('lokasi.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
