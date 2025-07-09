@extends('layout.main')

@section('content')
<div class="container my-5">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Pemesanan</h5>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Terjadi kesalahan:</strong>
                    <ul class="mb-0">
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
                    <label class="form-label fw-semibold">Produk</label>
                    <input type="text" class="form-control" value="{{ $produkTerpilih->nama }}" readonly>
                    <input type="hidden" name="produk_id" value="{{ $produkTerpilih->id }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Lokasi</label>
                    <select name="lokasi_id" id="lokasi_id" class="form-select" required>
                        <option value="">-- Pilih Lokasi --</option>
                        @foreach ($lokasis as $lokasi)
                            <option 
                                value="{{ $lokasi->id }}"
                                data-harga="{{ $lokasi->harga }}"
                                data-ukuran="{{ $lokasi->ukuran }}"
                                {{ $pemesanan->lokasi_id == $lokasi->id ? 'selected' : '' }}>
                                {{ $lokasi->alamat }} - Rp{{ number_format($lokasi->harga) }} / bulan
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Pemesan</label>
                    <input type="text" name="nama" class="form-control" value="{{ $pemesanan->nama }}" required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $pemesanan->email }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control" value="{{ $pemesanan->telepon }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Ukuran</label>
                    <input type="text" name="ukuran" id="ukuran" class="form-control" value="{{ $pemesanan->ukuran }}" readonly required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" max="1" readonly
                            value="{{ $pemesanan->jumlah }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Lama Sewa (Bulan)</label>
                        <input type="number" name="lama_sewa" id="lama_sewa" class="form-control" min="1"
                            value="{{ $pemesanan->lama_sewa }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Total Harga</label>
                    <input type="text" id="total_harga_display" class="form-control" readonly>
                    <input type="hidden" name="total_harga" id="total_harga" value="{{ $pemesanan->total_harga }}">
                </div>

                @if (Auth::check() && Auth::user()->role === 'a')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="menunggu" {{ $pemesanan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ $pemesanan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $pemesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                @endif

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Pemesanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lokasiSelect = document.getElementById('lokasi_id');
        const ukuranInput = document.getElementById('ukuran');
        const jumlahInput = document.getElementById('jumlah');
        const stokProduk = {{ $produkTerpilih->stok }};
        const lamaSewaInput = document.getElementById('lama_sewa');
        const totalHargaDisplay = document.getElementById('total_harga_display');
        const totalHargaInput = document.getElementById('total_harga');

        function updateUkuran() {
            const selected = lokasiSelect.options[lokasiSelect.selectedIndex];
            const ukuran = selected ? selected.getAttribute('data-ukuran') : '';
            ukuranInput.value = ukuran || '';
        }

        function hitungTotal() {
            const selected = lokasiSelect.options[lokasiSelect.selectedIndex];
            const harga = parseInt(selected ? selected.getAttribute('data-harga') : 0) || 0;
            const lama = parseInt(lamaSewaInput.value || 1);
            const jumlah = parseInt(jumlahInput.value || 1);

            if (jumlah > stokProduk) {
                alert(`Jumlah melebihi stok yang tersedia! Stok tersedia hanya ${stokProduk}.`);
                jumlahInput.value = stokProduk;
            }

            const total = harga * jumlah * lama;
            totalHargaDisplay.value = 'Rp ' + total.toLocaleString('id-ID');
            totalHargaInput.value = total;
        }

        lokasiSelect.addEventListener('change', function () {
            updateUkuran();
            hitungTotal();
        });

        jumlahInput.addEventListener('input', hitungTotal);
        lamaSewaInput.addEventListener('input', hitungTotal);

        updateUkuran();
        hitungTotal();
    });
</script>
@endsection
