@extends('layouts.loginregister')

@section('title', 'Atur Ulang Kata Sandi')

@section('content')
<style>
  body {
    background: linear-gradient(135deg, #ff0000, #00ff00);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
  }

  .card {
    backdrop-filter: blur(10px);
    background-color: rgb(255, 255, 255);
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
    color: #333;
  }

  label, p, h5, h4 {
    color: #000;
  }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow border-0 w-100" style="max-width: 500px;">
        <div class="card-header bg-success text-white text-center">
            <h5 class="mb-0">Atur Ulang Kata Sandi</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required
                        value="{{ old('email', $request->email) }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Kata Sandi Baru</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Kata Sandi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('login') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan Kata Sandi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
