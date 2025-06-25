@extends('layout.main')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Pemesanan</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Lokasi</th>
                    <th>Nama Pemesan</th>
                    <th>Ukuran</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pemesanans as $pemesanan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemesanan->produk->nama ?? '-' }}</td>
                        <td>{{ $pemesanan->lokasi->alamat ?? '-' }}</td>
                        <td>{{ $pemesanan->nama }}</td>
                        <td>{{ $pemesanan->ukuran ?? '-' }}</td>
                        <td>{{ $pemesanan->jumlah }}</td>
                        <td>Rp{{ number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $status = $pemesanan->status;
                                $badgeClass = match ($status) {
                                    'menunggu' => 'secondary',
                                    'diproses' => 'warning',
                                    'selesai' => 'success',
                                    default => 'dark',
                                };
                            @endphp
                            <span class="badge bg-{{ $badgeClass }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('pemesanan.edit', $pemesanan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('pemesanan.destroy', $pemesanan->id) }}" method="POST" onsubmit="return confirm('Hapus pemesanan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada pemesanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection