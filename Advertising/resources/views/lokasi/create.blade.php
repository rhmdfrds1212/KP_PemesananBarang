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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('lokasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-semibold">
                                <i class="bi bi-house-door me-1 text-success"></i> Alamat Lokasi
                            </label>
                            <textarea name="alamat" class="form-control" rows="2" required placeholder="Contoh: Jl. Soekarno Hatta No. 99">{{ old('alamat') }}</textarea>
                        </div>

                        <div class="mt-3">
                            <label for="produk_nama" class="form-label fw-semibold">
                                <i class="bi bi-tags-fill me-1 text-info"></i> Jenis Produk
                            </label>
                            <select name="produk_nama" id="produk_nama" class="form-select" required>
                                <option value="">-- Pilih Produk --</option>
                                <option value="baliho" {{ old('produk_nama') == 'baliho' ? 'selected' : '' }}>Baliho</option>
                                <option value="billboard" {{ old('produk_nama') == 'billboard' ? 'selected' : '' }}>Billboard</option>
                                <option value="videotron" {{ old('produk_nama') == 'videotron' ? 'selected' : '' }}>Videotron</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="ukuran" class="form-label fw-semibold">
                                <i class="bi bi-aspect-ratio me-1 text-primary"></i> Ukuran
                            </label>
                            <select name="ukuran" id="ukuran" class="form-select" required>
                                <option value="">-- Pilih Ukuran --</option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <label for="status" class="form-label fw-semibold">
                                <i class="bi bi-info-circle-fill me-1 text-warning"></i> Status Lokasi
                            </label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="tersewa" {{ old('status') == 'tersewa' ? 'selected' : '' }}>Tersewa</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="harga" class="form-label fw-semibold">
                                <i class="bi bi-cash-stack me-1 text-success"></i> Harga Sewa (Per Bulan)
                            </label>
                            <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required placeholder="Contoh: 5000000">
                            <small class="text-muted">Masukkan harga sewa lokasi per bulan (tanpa titik/koma).</small>
                        </div>

                        <div class="mt-3">
                            <label for="foto" class="form-label fw-semibold">
                                <i class="bi bi-image-fill me-1 text-danger"></i> Upload Foto Lokasi
                            </label>
                            <input type="file" name="foto" class="form-control">
                            <small class="text-muted">Format gambar: jpg, jpeg, png. Ukuran maksimal 2MB.</small>
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
<script>
    const ukuranMap = {
        baliho: ['6 x 4 M Vertical', '4 x 8 M Horizontal'],
        billboard: ['5 x 5 M Vertical' ,'10 x 5 M Vertical', '12 x 4 M Vertical'],
        videotron: ['4 x 2 M Horizontal', '6 x 4 M Vertical']
    };

    const produkSelect = document.getElementById('produk_nama');
    const ukuranSelect = document.getElementById('ukuran');

    produkSelect.addEventListener('change', function() {
        const selectedProduk = this.value;
        ukuranSelect.innerHTML = '<option value="">-- Pilih Ukuran --</option>';

        if (ukuranMap[selectedProduk]) {
            ukuranMap[selectedProduk].forEach(function(uk) {
                const opt = document.createElement('option');
                opt.value = uk;
                opt.textContent = uk;
                ukuranSelect.appendChild(opt);
            });
        }
    });

    // Trigger saat halaman pertama kali jika ada old input
    document.addEventListener('DOMContentLoaded', function() {
        const event = new Event('change');
        produkSelect.dispatchEvent(event);
    });
</script>
@endsection
