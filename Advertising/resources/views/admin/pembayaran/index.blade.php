@extends('layout.main')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 fw-bold">Kelola Pembayaran</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pemesan</th>
                    <th>Produk</th>
                    <th>Metode</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pembayarans as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->pemesanan->nama }}</td>
                        <td>{{ $item->pemesanan->produk->nama }}</td>
                        <td>{{ ucfirst($item->metode) }}</td>
                        <td>
                            <span class="badge 
                                {{ $item->status == 'pending' ? 'bg-warning' : 
                                   ($item->status == 'diterima' ? 'bg-success' : 'bg-danger') }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank">
                                Lihat Bukti
                            </a>
                        </td>
                        <td>
                            @if($item->status == 'pending')
                                <form action="{{ route('pembayaran.updateStatus', ['id' => $item->id, 'status' => 'diterima']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-success btn-sm" onclick="return confirm('Terima pembayaran ini?')">
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('pembayaran.updateStatus', ['id' => $item->id, 'status' => 'ditolak']) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Tolak pembayaran ini?')">
                                        Tolak
                                    </button>
                                </form>
                            @else
                                <em>Tidak ada aksi</em>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data pembayaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
