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
            <label class="form-label">Produk</label>
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
            <label for="lokasi_id" class="form-label">Lokasi</label>
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
            <label for="nama" class="form-label">Nama Pemesan</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (Opsional)</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon (Opsional)</label>
            <input type="text" name="telepon" class="form-control" value="{{ old('telepon') }}">
        </div>

        <div class="mb-3">
            <label for="ukuran" class="form-label">Ukuran</label>
            <select name="ukuran" class="form-select" required>
                <option value="">-- Pilih Ukuran --</option>
                <option value="4 x 6 M Vertical" {{ old('ukuran') == '4 x 6 M Vertical' ? 'selected' : '' }}>4 x 6 M Vertical</option>
                <option value="8 x 4 M Horizontal" {{ old('ukuran') == '8 x 4 M Horizontal' ? 'selected' : '' }}>8 x 4 M Horizontal</option>
                <option value="5 x 10 M Vertical" {{ old('ukuran') == '5 x 10 M Vertical' ? 'selected' : '' }}>5 x 10 M Vertical</option>
                <option value="6 x 12 M Vertical" {{ old('ukuran') == '6 x 12 M Vertical' ? 'selected' : '' }}>6 x 12 M Vertical</option>
                <option value="2 x 4 M Horizontal" {{ old('ukuran') == '2 x 4 M Horizontal' ? 'selected' : '' }}>2 x 4 M Horizontal</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" id="jumlah" min="1" value="{{ old('jumlah', 1) }}" required>
        </div>

        <div class="mb-3">
            <label for="lama_sewa" class="form-label">Lama Sewa</label>
            <select name="lama_sewa" id="lama_sewa" class="form-select" required>
                <option value="">-- Pilih Lama Sewa --</option>
                <option value="1" {{ old('lama_sewa') == '1' ? 'selected' : '' }}>1 Tahun</option>
                <option value="2" {{ old('lama_sewa') == '2' ? 'selected' : '' }}>2 Tahun</option>
                <option value="3" {{ old('lama_sewa') == '3' ? 'selected' : '' }}>3 Tahun</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="total_harga_display" class="form-label">Total Harga</label>
            <input type="text" id="total_harga_display" class="form-control" readonly>
            <input type="hidden" name="harga_sewa" id="harga_sewa">
            <input type="hidden" name="total_harga" id="total_harga">
        </div>

        <button type="submit" class="btn btn-success">Pesan Sekarang</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

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
