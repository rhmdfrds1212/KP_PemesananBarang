@extends('layout.main')

@section('content')
<div class="container mt-5">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php $totalHarga = 0; @endphp 

    @if(count($keranjang) > 0)
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h4 class="mb-0">Keranjang Belanja</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light text-center">
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($keranjang as $item)
                                @php 
                                    $subtotal = $item['harga'] * $item['total_harga']; 
                                    $totalHarga += $subtotal;
                                @endphp
                                <tr>
                                    <td class="text-start fw-semibold">{{ $item['nama'] }}</td>
                                    <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                                    <td>{{ $item['total_harga'] }}</td>
                                    <td class="text-success fw-bold">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                                    <td>
                                        <form action="{{ route('keranjang.delete', $item['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $item['nama'] }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end align-items-center mt-4">
                    <div class="me-4">
                        <h5>Total Belanja: <span class="text-danger fw-bold">Rp{{ number_format($totalHarga, 0, ',', '.') }}</span></h5>
                    </div>
                    <a href="{{ route('pemesanan.create',  ['id' => $item['id']]) }}" class="btn btn-success btn-lg shadow-sm">Checkout</a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning text-center">Keranjang belanja masih kosong.</div>
    @endif

</div>

{{-- Bootstrap Icon CDN --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
