@extends('layout.main')

@section('title', 'Verifikasi Email')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 500px; width: 100%;">
        <div class="card-body p-5">

            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" width="100">
                <h3 class="mt-3">Verifikasi Email Anda</h3>
            </div>

            <div class="mb-3 text-muted text-center">
                <p>
                    Terima kasih telah mendaftar! Sebelum mulai, silakan verifikasi alamat email Anda dengan klik link yang telah kami kirim ke email Anda.
                </p>
                <p>
                    Jika Anda belum menerima email verifikasi, klik tombol di bawah untuk mengirim ulang.
                </p>
            </div>

            {{-- Notifikasi jika sudah mengirim ulang --}}
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success text-center">
                    Link verifikasi baru telah dikirim ke email Anda!
                </div>
            @endif

            <div class="d-grid gap-2">
                {{-- Form Resend --}}
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-envelope"></i> Kirim Ulang Email Verifikasi
                    </button>
                </form>

                {{-- Form Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary w-100">
                        <i class="bi bi-box-arrow-left"></i> Keluar
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection