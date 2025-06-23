@extends('layouts.loginregister')

@section('content')
<section class="d-flex justify-content-center align-items-center py-3 py-md-5" style="background-color: #f6f6f6; min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
        <div class="bg-white p-4 p-md-5 rounded shadow-sm">
          <div class="row">
            <div class="col-12">
              <div class="text-center mb-5">
                <a href="#">
                  <img src="{{ asset('images/logo.png') }}" alt="Logo" width="150" height="90">
                </a>
              </div>
            </div>
          </div>
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row gy-3 gy-md-4 overflow-hidden">

              {{-- First Name --}}
              <div class="col-12 col-md-6">
                <label for="firstName" class="form-label">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="firstName" id="firstName" required>
              </div>

              {{-- Last Name --}}
              <div class="col-12 col-md-6">
                <label for="lastName" class="form-label">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="lastName" id="lastName" required>
              </div>

              {{-- Email --}}
              <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" id="email" required>
              </div>

              {{-- Password --}}
              <div class="col-12">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>

              {{-- Password Confirmation --}}
              <div class="col-12">
                <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
              </div>

              {{-- Agree Terms --}}
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                  <label class="form-check-label text-secondary" for="iAgree">
                    I agree to the <a href="#" class="link-success text-decoration-none">terms and conditions</a>
                  </label>
                </div>
              </div>

              {{-- Submit Button --}}
              <div class="col-12">
                <div class="d-grid">
                  <button class="btn btn-success btn-lg" type="submit">Sign Up</button>
                </div>
              </div>

            </div>
          </form>

          <div class="row">
            <div class="col-12">
              <hr class="mt-5 mb-4 border-secondary-subtle">
              <p class="m-0 text-secondary text-center">Already have an account? <a href="{{ route('login') }}" class="link-success text-decoration-none">Sign in</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
