@extends('layout.main')

@section('content')

<div class="container py-5">
    <div class="bg-white shadow rounded p-4">
        <h3 class="mb-4 fw-bold text-center">Edit Produk</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text" name="nama" class="form-control" value="{{ $produk->nama }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="4" required>{{ $produk->deskripsi }}</textarea>
            </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="{{ $produk->stok }}" required>
                </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="Baliho" {{ $produk->kategori == 'Baliho' ? 'selected' : '' }}>Baliho</option>
                    <option value="Billboard" {{ $produk->kategori == 'Billboard' ? 'selected' : '' }}>Billboard</option>
                    <option value="Videotron" {{ $produk->kategori == 'Videotron' ? 'selected' : '' }}>Videotron</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Produk</label><br>
                @if ($produk->foto)
                    <img src="{{ asset('upload/produk/' . $produk->foto) }}" alt="" width="120" class="mb-2">
                @endif
                <input type="file" name="foto" class="form-control">
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-success">
                    Update Produk
                </button>
            </div>
        </form>
    </div>
</div>

@endsection