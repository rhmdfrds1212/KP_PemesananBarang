@extends('layout.main')

@section('content')
<div class="py-5" style="background-color: #f5f5f5;">
    <div class="container">
        <div class="bg-white p-4 rounded shadow-sm">
            <h3 class="mb-4">Pembayaran Pemesanan</h3>

            {{-- Detail Pemesanan --}}
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

            {{-- Informasi Pembayaran --}}
            <div class="alert alert-info" id="info-pembayaran" style="display: none;">
                <div id="rekening-info" style="display: none;">
                    <h5>Transfer ke rekening berikut:</h5>
                    <p><strong id="rekening-nama"></strong></p>
                    <p>No Rekening: <span id="rekening-nomor"></span></p>
                    <button onclick="copyRekening()" class="btn btn-sm btn-outline-secondary">Salin Nomor Rekening</button>
                </div>
                <div id="qr-info" style="display: none;" class="text-center">
                    <h5>Scan QRIS untuk Pembayaran:</h5>
                    <img src="{{ asset('images/qr.png') }}" alt="QRIS" style="max-width:200px;">
                </div>
            </div>

            {{-- Form Pembayaran --}}
            <form action="{{ route('pembayaran.store', $pemesanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="bca">Transfer BCA</option>
                        <option value="bri">Transfer BRI</option>
                        <option value="qris">QRIS</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="bukti_pembayaran" class="form-label">Upload Bukti Pembayaran</label>
                    <input type="file" name="bukti_pembayaran" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan (Opsional)</label>
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
        'bca': { nama: 'CV. Ramanisa', nomor: '1234567890' },
        'bri': { nama: 'CV. Ramanisa', nomor: '9876543210' }
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

        if (metode === 'bca' || metode === 'bri') {
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
</script>
@endsection