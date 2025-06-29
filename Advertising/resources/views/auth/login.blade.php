@extends('layouts.loginregister')

@section('content')
<style>
  body {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0,0,0,0.7)), 
                url('{{ asset('images/bg-advertising.jpg') }}') no-repeat center center fixed;
    background-size: cover;
  }
  .card {
    backdrop-filter: blur(10px);
    background-color: rgb(255, 255, 255);
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.5);
    color: white;
  }
  label, p, h5, h4 {
    color: rgb(0, 0, 0);
  }
</style>

<section class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card p-4">
          <div class="text-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" width="250">
            <h4 class="mt-3 fw-bold text-success">RA WHITE MEDIA PROMOSINDO</h4>
          </div>
          <h5 class="text-secondary text-center mb-3">Login ke akun Anda</h5>

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="d-flex justify-content-between mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                  Ingat Saya
                </label>
              </div>
              <a href="{{ route('password.request') }}" class="text-danger">Lupa Password?</a>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-success">Masuk</button>
            </div>
          </form>

          <div class="text-center mt-3">
            <p>Belum punya akun? <a href="{{ route('register') }}" class="text-success fw-bold">Daftar</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
