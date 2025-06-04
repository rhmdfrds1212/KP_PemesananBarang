@extends('layout.main')

@section('title', 'Tentang Kami')

@section('content')
<section class="py-5 bg-light">
  <div class="container">
    <div class="row mb-4">
      <div class="col text-center">
        <h2 class="fw-bold">Tentang Kami</h2>
        <p class="text-muted">Mengenal lebih dekat siapa kami dan apa tujuan kami.</p>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ url('images/logo.png') }}" class="img-fluid rounded shadow" alt="Tentang Kami">
      </div>
      <div class="col-md-6">
        <h3 class="fw-semibold">Kami adalah Solusi untuk Iklan Digital Anda</h3>
        <p class="text-muted">Kami adalah tim kreatif yang berfokus pada penyediaan layanan periklanan yang efektif dan terjangkau. Dengan platform ini, kami membantu pelaku usaha dan individu untuk mempromosikan produk mereka ke target pasar yang tepat.</p>
        <p class="text-muted">Didirikan pada tahun 2025, misi kami adalah menjadi mitra terbaik dalam dunia periklanan digital, dengan mengedepankan kualitas layanan, transparansi, dan kecepatan.</p>
        <a href="{{ route('produk.index') }}" class="btn btn-success mt-3">Lihat Produk Iklan</a>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row text-center mb-4">
      <div class="col">
        <h4 class="fw-bold">Nilai-Nilai Kami</h4>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 border rounded shadow-sm">
          <i class="bi bi-bullseye text-primary fs-1 mb-3"></i>
          <h5 class="fw-bold">Fokus pada Hasil</h5>
          <p>Kami fokus pada efektivitas kampanye dan ROI yang tinggi bagi pelanggan kami.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 border rounded shadow-sm">
          <i class="bi bi-lightbulb text-warning fs-1 mb-3"></i>
          <h5 class="fw-bold">Kreativitas</h5>
          <p>Ide segar dan inovatif selalu menjadi inti dari setiap kampanye yang kami jalankan.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 border rounded shadow-sm">
          <i class="bi bi-people text-success fs-1 mb-3"></i>
          <h5 class="fw-bold">Kolaborasi</h5>
          <p>Kami percaya bahwa hasil terbaik muncul dari kolaborasi yang baik antara tim dan klien.</p>
        </div>
      </div>
      <div class="row mt-5">
      <div class="col text-center">
        <h5 class="fw-bold mb-3">Ikuti Kami:</h5>
        <div class="d-inline-flex gap-3">
          <a href="https://facebook.com" class="text-primary fs-4"><i class="fab fa-facebook"></i></a>
          <a href="https://twitter.com" class="text-info fs-4"><i class="fab fa-twitter"></i></a>
          <a href="https://instagram.com" class="text-danger fs-4"><i class="fab fa-instagram"></i></a>
          <a href="https://linkedin.com" class="text-primary fs-4"><i class="fab fa-linkedin"></i></a>
          <a href="https://youtube.com" class="text-danger fs-4"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
    </div>
    </div>
  </div>
</section>
@endsection
