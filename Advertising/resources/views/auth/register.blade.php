@extends('layouts.loginregister')

@section('content')
<style>
  body {
    background: linear-gradient(135deg, #ff0000, #00ff00); /* merah ke hijau */
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

<section class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card p-4">
          <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="250">
            <h4 class="mt-3 fw-bold text-success">RA WHITE MEDIA PROMOSINDO</h4>
          </div>
          <h5 class="text-center text-secondary mb-3">Daftar Akun Baru</h5>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
              <label>Nama Depan</label>
              <input type="text" name="firstName" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Nama Belakang</label>
              <input type="text" name="lastName" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label>Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-success">Daftar</button>
            </div>
          </form>
          <script>
            document.addEventListener("DOMContentLoaded", function () {
                const inputs = document.querySelectorAll("form input[required], form textarea[required]");

                inputs.forEach(function(input) {
                    input.addEventListener("invalid", function (e) {
                        e.preventDefault(); 
                        let name = input.getAttribute("name");
                        let pesan = "Field ini wajib diisi.";

                        if (name === "firstName") pesan = "Nama depan wajib diisi.";
                        if (name === "lastName") pesan = "Nama belakang wajib diisi.";
                        if (name === "email") pesan = "Email wajib diisi.";
                        if (name === "password") pesan = "Password wajib diisi.";
                        if (name === "password_confirmation") pesan = "Konfirmasi password wajib diisi.";

                        input.setCustomValidity(pesan);
                        input.reportValidity();
                    });

                    input.addEventListener("input", function () {
                        input.setCustomValidity("");
                    });
                });
            });
            </script>
          <div class="text-center mt-3">
            <p>Sudah punya akun? <a href="{{ route('login') }}" class="text-success fw-bold">Masuk</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection