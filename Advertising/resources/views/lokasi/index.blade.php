@extends('layout.main')

@section('title', 'Lokasi')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Daftar Lokasi</h1>

    {{-- Tombol Tambah Lokasi, hanya untuk Admin --}}
    @if (Auth::check() && Auth::user()->role === 'a')
        <a href="{{ route('lokasi.create') }}" class="btn btn-success col-lg-12 mb-3">
            + Tambah Lokasi
        </a>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Alamat</th>
                <th class="text-center">Latitude</th>
                <th class="text-center">Longitude</th>
                <th class="text-center">Status</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lokasi as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $item['alamat'] }}</td>
                    <td class="text-center">{{ $item['latitude'] }}</td>
                    <td class="text-center">{{ $item['longitude'] }}</td>
                    <td class="text-center">{{ $item['status'] }}</td>
                    <td class="text-center">
                        {{-- Tombol Edit hanya untuk Admin --}}
                        @if (Auth::check() && Auth::user()->role === 'a')
                            <a href="{{ route('lokasi.edit', $item['id']) }}" class="btn btn-sm btn-warning">
                                <i class="fa fa-pen"></i> Edit
                            </a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- SweetAlert untuk notifikasi --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
  <script>
    Swal.fire({
        title: "Sukses!",
        text: "{{ session('success') }}",
        icon: "success"
    });
  </script>
@endif
@endsection
