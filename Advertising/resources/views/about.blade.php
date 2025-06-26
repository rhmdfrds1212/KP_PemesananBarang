@extends('layout.main')

@section('title', 'Tentang Kami')

@section('content')

<section class="py-5 bg-light">
  <div class="container">
    <div class="row mb-5 text-center">
      <div class="col">
        <h2 class="fw-bold display-5">Tentang Kami</h2>
        <p class="text-muted">Kenali lebih dekat siapa kami dan apa visi kami.</p>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="{{ url('images/logo.png') }}" class="img-fluid rounded shadow-sm" alt="Tentang Kami">
      </div>
      <div class="col-md-6">
        <h3 class="fw-semibold mb-3">Solusi Inovatif untuk Iklan Digital Anda</h3>
        <p class="text-muted">Kami adalah tim kreatif yang berdedikasi dalam memberikan solusi periklanan yang efektif dan terjangkau. Kami membantu pelaku usaha dan individu menjangkau audiens yang tepat dengan media iklan yang strategis.</p>
        <p class="text-muted">Sejak 2025, kami berkomitmen menjadi mitra terbaik dalam dunia periklanan digital dengan mengutamakan kualitas layanan, transparansi, dan kecepatan.</p>
        <a href="{{ route('produk.index') }}" class="btn btn-success mt-3 shadow-sm px-4 py-2">Lihat Produk Iklan</a>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">
    <div class="row text-center mb-4">
      <div class="col">
        <h4 class="fw-bold text-uppercase">Nilai-Nilai Kami</h4>
        <p class="text-muted">Filosofi kerja yang menjadi fondasi pelayanan kami</p>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
          <i class="bi bi-bullseye text-primary fs-1 mb-3"></i>
          <h5 class="fw-bold">Fokus pada Hasil</h5>
          <p class="text-muted">Kami berorientasi pada efektivitas kampanye dan ROI yang tinggi bagi setiap klien.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
          <i class="bi bi-lightbulb text-warning fs-1 mb-3"></i>
          <h5 class="fw-bold">Kreativitas</h5>
          <p class="text-muted">Ide-ide segar dan inovatif menjadi kekuatan utama dari setiap layanan kami.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="p-4 border rounded shadow-sm h-100 text-center hover-shadow">
          <i class="bi bi-people text-success fs-1 mb-3"></i>
          <h5 class="fw-bold">Kolaborasi</h5>
          <p class="text-muted">Kami percaya bahwa kolaborasi yang baik akan menghasilkan solusi iklan terbaik.</p>
        </div>
      </div>
    </div>
    <div class="row mt-5">
      <div class="col text-center">
        <h5 class="fw-bold mb-3">Hubungi Kami</h5>
        <div class="d-inline-flex gap-4 fs-4">
          <a href="mailto:rawhite.adv@gmail.com" class="text-danger" title="Kirim Email">
            <i class="fas fa-envelope"></i>
          </a>
          <a href="https://wa.me/628127878578" class="text-success" title="Hubungi via WhatsApp">
            <i class="fas fa-phone-alt"></i>
          </a>
        </div>
        <p class="text-muted mt-2 small">Kami siap membantu kebutuhan promosi Anda kapan saja.</p>
      </div>
    </div>
  </div>
</section>

<style>
  .hover-shadow:hover {
    box-shadow: 0 4px 18px rgba(0, 0, 0, 0.15);
    transition: 0.3s ease;
  }
</style>
@endsection
