@extends('layout.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="mb-4 text-center">Edit Profil</h3>

                    @if (session('status') === 'profile-updated')
                        <div class="alert alert-success text-center">
                            Profil berhasil diperbarui.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" id="name" name="name" class="form-control"
                                   value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                            <p class="text-muted"><small>Email tidak bisa diubah</small></p>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('profile.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection