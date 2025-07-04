@extends('layouts.loginregister')

@section('title', 'Lupa Password')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #f7f7f7, #dfe9f3);
        min-height: 100vh;
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 w-100" style="max-width: 500px;">
        <div class="card-header bg-success   text-white text-center">
            <h5 class="mb-0">Lupa Kata Sandi</h5>
        </div>
        <div class="card-body">
            <p class="text-muted mb-3">
                Lupa kata sandi Anda? Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
            </p>

            <!-- Notifikasi Status -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Alamat Email</label>
                    <input id="email" type="email" 
                           class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('login') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">
                        Kirim Tautan Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection