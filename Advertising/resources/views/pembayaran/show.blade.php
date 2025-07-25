@extends('layout.main')

@section('content')
<div class="py-5" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="bg-white p-4 rounded shadow-sm">
            <h3 class="mb-4">Pembayaran Pemesanan</h3>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="mb-4">
                <h5 class="mb-3">Detail Pemesanan</h5>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nama Produk:</strong> {{ $pemesanan->produk->nama }}</li>
                    <li class="list-group-item"><strong>Ukuran:</strong> {{ $pemesanan->ukuran }}</li>
                    <li class="list-group-item"><strong>Jumlah:</strong> {{ $pemesanan->jumlah }}</li>
                    <li class="list-group-item"><strong>Lama Sewa:</strong> {{ $pemesanan->lama_sewa }} Bulan</li>
                    <li class="list-group-item"><strong>Lokasi:</strong> {{ $pemesanan->lokasi->alamat }}</li>
                    <li class="list-group-item"><strong>Total Harga:</strong> 
                        <span class="text-success fw-semibold">Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</span>
                    </li>
                </ul>
            </div>

            <div class="alert alert-info" id="info-pembayaran" style="display: none;">
                <div id="rekening-info" style="display: none;">
                    <h5>Transfer ke rekening berikut:</h5>
                    <p><strong id="rekening-nama"></strong></p>
                    <p>No Rekening: <span id="rekening-nomor"></span></p>
                    <button onclick="copyRekening()" class="btn btn-sm btn-outline-secondary">Salin Nomor Rekening</button>
                </div>
                <div id="qr-info" style="display: none;" class="text-center"></div>
            </div>

            <form action="{{ route('pembayaran.store', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="bca">Transfer BCA</option>
                        <option value="mandiri">Transfer MANDIRI</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan</label>
                    <textarea name="catatan" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary ms-2">Kembali</a>
            </form>
        </div>
    </div>
</div>

{{-- Script --}}
<script>
    const rekeningData = {
        'bca': { nama: 'An. Darmono', nomor: '3410407697' },
        'mandiri': { nama: 'An. Budiyanto', nomor: '113 000 203 6550' }
    };

    const metodeSelect = document.getElementById('metode_pembayaran');
    const infoDiv = document.getElementById('info-pembayaran');
    const rekeningDiv = document.getElementById('rekening-info');
    const qrDiv = document.getElementById('qr-info');

    metodeSelect.addEventListener('change', function() {
        const metode = this.value;
        infoDiv.style.display = 'none';
        rekeningDiv.style.display = 'none';
        qrDiv.style.display = 'none';

        if (metode === 'bca' || metode === 'mandiri') {
            infoDiv.style.display = 'block';
            rekeningDiv.style.display = 'block';
            document.getElementById('rekening-nama').innerText = rekeningData[metode].nama;
            document.getElementById('rekening-nomor').innerText = rekeningData[metode].nomor;
        } else if (metode === 'qris') {
            infoDiv.style.display = 'block';
            qrDiv.style.display = 'block';
        }
    });

    function copyRekening() {
        const nomor = document.getElementById('rekening-nomor').innerText;
        navigator.clipboard.writeText(nomor);
        alert('Nomor rekening disalin: ' + nomor);
    }
    document.querySelector('form').addEventListener('submit', function(e) {
        const fileInput = document.querySelector('input[name="bukti_pembayaran"]');
        if (!fileInput.value) {
            e.preventDefault();
            alert('Bukti pembayaran harus diunggah sebelum konfirmasi pembayaran!');
        }
    });
</script>

</script>
@endsection