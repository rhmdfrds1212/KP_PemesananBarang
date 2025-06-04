@extends('layout.main')

@section('content')

<style>
    .hero {
        background: url('{{ url('images/iklan.jpg') }}') center center/cover no-repeat;
        color: white;
        padding: 150px 0;
        text-align: center;
    }

    .service-icon {
        font-size: 48px;
        color: #0d6efd;
    }

    .testimonial {
        background-color: #f8f9fa;
        padding: 60px 0;
    }

    .cta {
        background-color: #0d6efd;
        color: white;
        padding: 80px 0;
        text-align: center;
    }

    footer {
        background-color: #222;
        color: #ccc;
        padding: 30px 0;
        text-align: center;
    }
</style>

{{-- Hero Section --}}
<section class="hero">
    <div class="container">
        <h1 class="display-4 fw-bold">Solusi Periklanan Advertising Terbaik</h1>
        <p class="lead">Tingkatkan visibilitas brand Anda dengan strategi pemasaran modern dan efektif.</p>
        <a href="#layanan" class="btn btn-light btn-lg mt-4">Lihat Layanan Kami</a>
    </div>
</section>

{{-- Layanan --}}
<section id="layanan" class="py-5">
    <div class="container text-center">
        <h2 class="mb-4">Layanan Kami</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm p-4">
                    <div class="service-icon mb-3">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>
                    <h5 class="card-title">Iklan Sosial Media</h5>
                    <p class="card-text">Optimasi iklan di platform seperti Instagram, Facebook, dan TikTok untuk menjangkau audiens target Anda.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm p-4">
                    <div class="service-icon mb-3">
                        <i class="bi bi-google"></i>
                    </div>
                    <h5 class="card-title">Google Ads & SEO</h5>
                    <p class="card-text">Strategi penempatan iklan dan SEO untuk mendongkrak pencarian dan trafik website Anda.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm p-4">
                    <div class="service-icon mb-3">
                        <i class="bi bi-phone-landscape"></i>
                    </div>
                    <h5 class="card-title">Pembuatan Konten</h5>
                    <p class="card-text">Tim kreatif kami akan membantu produksi konten berkualitas tinggi yang menjual dan menarik perhatian.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Statistik --}}
<section class="py-5 bg-light text-center">
    <div class="container">
        <h2 class="mb-4">Pencapaian Kami</h2>
        <div class="row">
            <div class="col-md-3">
                <h3 class="fw-bold">250+</h3>
                <p>Klien Aktif</p>
            </div>
            <div class="col-md-3">
                <h3 class="fw-bold">1.2M+</h3>
                <p>Impresi Iklan</p>
            </div>
            <div class="col-md-3">
                <h3 class="fw-bold">95%</h3>
                <p>Tingkat Kepuasan</p>
            </div>
            <div class="col-md-3">
                <h3 class="fw-bold">5+</h3>
                <p>Tahun Pengalaman</p>
            </div>
        </div>
    </div>
</section>

{{-- Testimoni --}}
<section class="testimonial">
    <div class="container text-center">
        <h2 class="mb-5">Apa Kata Klien Kami</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <blockquote class="blockquote">
                    <p>"........................"</p>
                    <footer class="blockquote-footer mt-2">nama</footer>
                </blockquote>
            </div>
            <div class="col-md-6">
                <blockquote class="blockquote">
                    <p>"..........................."</p>
                    <footer class="blockquote-footer mt-2">nama</footer>
                </blockquote>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta">
    <div class="container">
        <h2 class="mb-4">Siap Meningkatkan Bisnis Anda?</h2>
        <p class="lead">Hubungi kami untuk konsultasi gratis dan strategi iklan terbaik.</p>
        <p class="lead">Ingin tahu lebih banyak tentang siapa kami dan apa yang kami lakukan?</p>
        <a href="{{ route('tentangkami') }}" class="btn btn-light btn-lg">Pelajari Tentang Kami</a>
    </div>
</section>

{{-- Footer --}}
<footer>
    <div class="container">
        <p>&copy; {{ date('Y') }} CV. Ramanisa White Media Promosindo. All rights reserved.</p>
    </div>
</footer>

@endsection
