@extends('layout.main')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="bi bi-cart-plus-fill me-2"></i> Buat Pemesanan Baru</h5>
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

            <form action="{{ route('pemesanan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold"><i class="bi bi-box-seam me-1"></i> Produk</label>
                    @if (isset($produkTerpilih))
                        <input type="text" class="form-control" value="{{ $produkTerpilih->nama }}" readonly>
                        <input type="hidden" name="produk_id" value="{{ $produkTerpilih->id }}">
                    @else
                        <select name="produk_id" class="form-select" required id="produk_id">
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($produks as $produk)
                                <option value="{{ $produk->id }}" {{ old('produk_id') == $produk->id ? 'selected' : '' }}>
                                    {{ $produk->nama }} - Rp{{ number_format($produk->harga, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold"><i class="bi bi-geo-alt me-1"></i> Lokasi</label>
                    <select name="lokasi_id" class="form-select" required>
                        <option value="">-- Pilih Lokasi --</option>
                        @foreach ($lokasis as $lokasi)
                            <option value="{{ $lokasi->id }}" {{ old('lokasi_id') == $lokasi->id ? 'selected' : '' }}>
                                {{ $lokasi->alamat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nama" class="form-label fw-semibold"><i class="bi bi-person-fill me-1"></i> Nama Pemesan</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold"><i class="bi bi-envelope-fill me-1"></i> Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="telepon" class="form-label fw-semibold"><i class="bi bi-telephone-fill me-1"></i> Telepon</label>
                        <input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ukuran" class="form-label fw-semibold"><i class="bi bi-arrows-fullscreen me-1"></i> Ukuran</label>
                    <select name="ukuran" class="form-select" required>
                        <option value="">-- Pilih Ukuran --</option>
                        @foreach ([
                            '4 x 6 M Vertical', '8 x 4 M Horizontal',
                            '5 x 10 M Vertical', '6 x 12 M Vertical',
                            '2 x 4 M Horizontal'
                        ] as $ukuran)
                            <option value="{{ $ukuran }}" {{ old('ukuran') == $ukuran ? 'selected' : '' }}>{{ $ukuran }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="jumlah" class="form-label fw-semibold"><i class="bi bi-stack me-1"></i> Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" id="jumlah" min="1" value="{{ old('jumlah', 1) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lama_sewa" class="form-label fw-semibold"><i class="bi bi-clock-history me-1"></i> Lama Sewa</label>
                        <select name="lama_sewa" id="lama_sewa" class="form-select" required>
                            <option value="">-- Pilih Lama Sewa --</option>
                            <option value="1" {{ old('lama_sewa') == '1' ? 'selected' : '' }}>1 Tahun</option>
                            <option value="2" {{ old('lama_sewa') == '2' ? 'selected' : '' }}>2 Tahun</option>
                            <option value="3" {{ old('lama_sewa') == '3' ? 'selected' : '' }}>3 Tahun</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold"><i class="bi bi-cash-coin me-1"></i> Total Harga</label>
                    <input type="text" id="total_harga_display" class="form-control" readonly>
                    <input type="hidden" name="harga_sewa" id="harga_sewa">
                    <input type="hidden" name="total_harga" id="total_harga">
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi"></i> Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const produkSelect = document.getElementById('produk_id');
        const lamaSewaSelect = document.getElementById('lama_sewa');
        const jumlahInput = document.getElementById('jumlah');
        const hargaSewaInput = document.getElementById('harga_sewa');
        const totalHargaHidden = document.getElementById('total_harga');
        const totalHargaDisplay = document.getElementById('total_harga_display');

        let produkMap = {};
        @foreach ($produks as $p)
            produkMap["{{ $p->id }}"] = { harga: {{ $p->harga }}, stok: {{ $p->stok }} };
        @endforeach

        function updateTotalHarga() {
            const produkId = produkSelect ? produkSelect.value : '{{ $produkTerpilih->id ?? "" }}';
            const lamaSewa = parseInt(lamaSewaSelect.value || 0);
            const jumlah = parseInt(jumlahInput.value || 0);

            if (!produkId || !produkMap[produkId]) {
                totalHargaDisplay.value = '';
                hargaSewaInput.value = '';
                totalHargaHidden.value = '';
                return;
            }

            const produk = produkMap[produkId];
            if (jumlah > produk.stok) {
                alert('Jumlah yang dipesan melebihi stok yang tersedia!');
                jumlahInput.value = produk.stok;
                return updateTotalHarga();
            }

            const total = produk.harga * jumlah * lamaSewa;

            hargaSewaInput.value = produk.harga;
            totalHargaHidden.value = total;
            totalHargaDisplay.value = total > 0 ? 'Rp ' + total.toLocaleString('id-ID') : '';
        }

        if (produkSelect) produkSelect.addEventListener('change', updateTotalHarga);
        lamaSewaSelect.addEventListener('change', updateTotalHarga);
        jumlahInput.addEventListener('input', updateTotalHarga);
        updateTotalHarga();
    });
</script>
@endsection
