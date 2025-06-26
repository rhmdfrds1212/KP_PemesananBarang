@extends('layout.main')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold mb-4">Kelola Pelanggan</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('pelanggan.edit', $user->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>

                    <form action="{{ route('pelanggan.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah yakin ingin menghapus?')" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pelanggan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
