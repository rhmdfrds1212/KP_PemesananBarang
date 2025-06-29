@extends('layout.main')

@section('content')

<style>
    body {
        background-color: #f8f9fa;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    /* Hero Section */
    .hero {
        width: 100vw;
        height: 100vh;
        background: url('{{ url('images/iklan.png') }}') center center/cover no-repeat;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        text-align: left;
        padding-left: 80px;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
    }

    .hero .content {
        position: relative;
        z-index: 2;
    }

    .hero h1 {
        font-size: clamp(2rem, 8vw, 5rem);
        font-weight: 900;
        background: linear-gradient(to right, #e53935, #43a047);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-fill-color: transparent;
    }

    .hero p {
        font-size: clamp(1rem, 2vw, 1.5rem);
        margin-top: 1rem;
        color: #00ff66;
        max-width: 600px;
    }

    /* Section */
    section {
        padding: 80px 0;
    }

    section:nth-child(even) {
        background-color: #f8f9fa;
    }

    section:nth-child(odd) {
        background-color: #ffffff;
    }

    .section-title {
        font-weight: 700;
        color: #333;
        margin-bottom: 30px;
        text-align: center;
    }

    .section-title span {
        color: #e53935;
    }

    /* Footer */
    footer {
        background-color: #222;
        color: #bbb;
        padding: 60px 0 30px 0;
    }

    footer h5 {
        color: #fff;
        margin-bottom: 20px;
    }

    footer p, footer a {
        color: #bbb;
        font-size: 14px;
    }

    footer a:hover {
        color: #00ff66;
        text-decoration: underline;
    }

    footer .social-icons a {
        margin-right: 10px;
        color: #bbb;
        transition: color 0.3s ease;
    }

    footer .social-icons a:hover {
        color: #00ff66;
    }

    footer .logo-footer {
        width: 180px;
        margin-bottom: 20px;
    }

    .line-footer {
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        margin-top: 30px;
        padding-top: 20px;
        text-align: center;
        color: #777;
        font-size: 13px;
    }
</style>



<section class="hero">
    <div class="content">
        <h1>RAMANISA WHITE <br> MEDIA PROMOSINDO</h1>
    </div>
</section>

<section id="cerita" class="py-5" style="background-color: #22763d;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="{{ url('images/iklan.png') }}" alt="Tentang Kami" 
                     class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md-6 text-white">
                <h2 class="fw-bold mb-3" style="text-transform: uppercase;">
                    Cerita Kami
                </h2>
                <hr style="border: 2px solid white; width: 80px; margin-left: 0;">
                <p class="mt-4">
                    Berdiri di kota Palembang, Sumatera Selatan, pada tahun 1985 oleh Alm. Bapak Heru Arttans. 
                    Selama lebih dari 35 tahun, <strong>CV. Ramanisa White Media Promosindo</strong> terus berkomitmen memberikan layanan terbaik untuk klien-klien kami.
                </p>
                <p>
                    Kami adalah pelopor perusahaan advertising di Palembang yang memperkenalkan media 
                    <strong>Neon Sign</strong>. Dengan semangat tinggi dan dedikasi, kami telah memproduksi media iklan indoor dan outdoor untuk lebih dari <strong>50 merek</strong> berbeda.
                </p>
                <p>
                    Kami juga dipercaya menjadi mitra dalam event berskala nasional dan internasional seperti 
                    <strong>PON (2004)</strong>, <strong>SEA Games (2011)</strong>, dan <strong>International Surya Dragon Boat (Padang)</strong>.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: #f8f9fa; width: 100vw;">
    <div class="container-fluid text-center px-5">
        <h2 class="mb-4 fw-bold text-uppercase">Galeri Baliho & Billboard</h2>
        
        <div class="d-flex flex-wrap overflow-auto justify-content-center gap-4">
            @for ($i = 1; $i <= 6; $i++)
                <div class="gallery-item" style="flex: 0 0 calc(33.333% - 20px); max-width: calc(33.333% - 20px);">
                    <img src="{{ url('images/gambar/gambar' . $i . '.jpg') }}" 
                         class="img-fluid rounded shadow w-100" 
                         alt="gambar{{ $i }}">
                </div>
            @endfor
        </div>
    </div>
</section>

<section id="klien" class="section primary-section">
    <div class="container">
        <h2 class="fw-bold mb-4 text-center">KLIEN KAMI</h2>
        <p class="text-center mb-5">Kami dipercaya oleh berbagai perusahaan ternama dari berbagai industri.</p>
        <div class="row text-center">
            <div class="col-md-3">
                <img src="{{ url('images/logo1.png') }}" alt="Klien 1" class="img-fluid grayscale">
            </div>
            <div class="col-md-3">
                <img src="{{ url('images/logo2.png') }}" alt="Klien 2" class="img-fluid grayscale">
            </div>
            <div class="col-md-3">
                <img src="{{ url('images/logo3.png') }}" alt="Klien 3" class="img-fluid grayscale">
            </div>
            <div class="col-md-3">
                <img src="{{ url('images/logo4.png') }}" alt="Klien 4" class="img-fluid grayscale">
            </div>
        </div>
    </div>
</section>

<section id="lokasi" class="section bg-light">
    <div class="container text-center">
        <div class="mb-4">
            <iframe 
                src="https://www.google.com/maps?q=-3.023636,104.780753&output=embed" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row text-start">
            <div class="col-md-4 mb-4">
                <img src="{{ url('images/logo.png') }}" alt="Logo" class="logo-footer">
                <p class="mt-3">
                    CV. Ramanisa White Media Promosindo adalah perusahaan periklanan terpercaya sejak 1985. 
                    Kami berkomitmen membantu bisnis Anda tampil lebih menonjol.
                </p>
            </div>

            <div class="col-md-4 mb-4">
                <h5>Jam Operasional</h5>
                <p>Senin – Sabtu : 08:00 - 17:00</p>
                <p>Minggu : Tutup</p>
            </div>

            <div class="col-md-4 mb-4">
                <h5>Hubungi Kami</h5>
                <p>Jl. Pangeran Ratu, Komplek TOP100 Blok A7-27 Jakabaring - Palembang, Sumatera Selatan, 30134</p>
                <p><strong>Email:</strong> <a href="mailto:rawhite.adv@gmail.com">rawhite.adv@gmail.com</a></p>
                <p><strong>Telp:</strong> <a href="tel:+628127878578">+62 812-7878-578</a></p>
                <p><strong>Whatsapp:</strong> <a href="https://wa.me/628127878578">+62 812-7878-578</a></p>
            </div>
        </div>

        <div class="line-footer">
            &copy; 2025 CV. Ramanisa White Media Promosindo. All rights reserved.
        </div>
    </div>
</footer>
@endsection