@extends('layout.main')

@section('content')
<div class="container mt-5">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @php $totalHarga = 0; @endphp {{-- Tambahkan baris ini untuk menghindari error --}}

    @if(count($keranjang) > 0)
        <div class="table-responsive">
            <table class="table align-middle border">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keranjang as $item)
                        @php 
                            $subtotal = $item['harga'] * $item['total_harga']; 
                            $totalHarga += $subtotal;
                        @endphp
                        <tr>
                            <td><strong>{{ $item['nama'] }}</strong></td>
                            <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                            <td>{{ $item['total_harga'] }}</td>
                            <td>Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('keranjang.delete', $item['id']) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus {{ $item['nama'] }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end align-items-center mt-4">
            <div class="me-4">
                <h5>Total: <strong class="text-danger">Rp{{ number_format($totalHarga, 0, ',', '.') }}</strong></h5>
            </div>
            <a href="#" class="btn btn-success btn-lg">Checkout</a>
        </div>
    @else
        <div class="alert alert-warning">Keranjang belanja masih kosong.</div>
    @endif
</div>
@endsection
