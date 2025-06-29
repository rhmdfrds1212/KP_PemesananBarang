@extends('layout.main')

@section('content')

<style>
    body {
        background-color: #f4f7f6;
        color: #333;
        font-family: 'Poppins', sans-serif;
    }

    /* Hero Section */
    .hero {
        width: 100vw;
        height: 100vh;
        background: linear-gradient(to bottom, rgba(0,0,0,0.7), rgba(0,0,0,0.7)),
                    url('{{ url('images/iklan.png') }}') center center/cover no-repeat;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding-left: 80px;
        overflow: hidden;
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
        color: #eeeeee;
        max-width: 600px;
    }

    /* Section General */
    section {
        padding: 80px 0;
    }

    section:nth-child(even) {
        background-color: #f9fbfc;
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
        color: #0072ff;
    }

    /* Cerita Section */
    #cerita {
        background: linear-gradient(to right, #131313);
        color: #fff;
    }

    #cerita h2 {
        text-transform: uppercase;
    }

    #cerita hr {
        border: 2px solid white;
        width: 80px;
        margin-left: 0;
    }

    /* Galeri Section */
    .gallery-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .gallery-item:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }

    /* Klien Section */
    #klien {
        background-color: #f7fafc;
    }

    .grayscale {
        filter: grayscale(100%);
        transition: filter 0.3s ease;
    }

    .grayscale:hover {
        filter: grayscale(0%);
    }

    /* Footer */
    footer {
        background-color: #1a1a1a;
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
        color: #00c6ff;
        text-decoration: underline;
    }

    footer .social-icons a {
        margin-right: 10px;
        color: #bbb;
        transition: color 0.3s ease;
    }

    footer .social-icons a:hover {
        color: #00c6ff;
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

<section id="cerita" style="min-height: 100vh; background-color: #000000;">
    <div class="d-flex flex-wrap" style="min-height: 100vh;">
        
        <div class="col-12 col-md-6 p-0" 
             style="
                 background: url('{{ url('images/iklan.png') }}') center center / cover no-repeat;
                 min-height: 100vh;
             ">
        </div>

        <div class="col-12 col-md-6 text-white p-5 d-flex flex-column justify-content-center" 
             style="background-color: #131313;">
            <h2 class="fw-bold mb-3 text-uppercase" style="letter-spacing: 2px;">
                Cerita Kami
            </h2>
            <hr style="border: 2px solid white; width: 80px; margin-left: 0;">

            <p class="mt-4" style="line-height: 1.8; font-size: 1.1rem;">
                CV. Ramanisa White Media Promosindo adalah perusahaan yang berdiri dan tumbuh di kota Palembang. 
                Jujur kami sampaikan, perusahaan ini berdiri berkat kerja keras, dedikasi, 
                dan semangat untuk membantu banyak bisnis dan instansi dalam memperkenalkan produk dan layanan
                 mereka ke masyarakat luas..
            </p>
            <p style="line-height: 1.8; font-size: 1.1rem;">
                Perjalanan perusahaan ini sudah melewati berbagai tantangan, mulai dari perubahan tren media promosi, 
                perkembangan teknologi, hingga peralihan dari media konvensional ke digital.
            </p>
            <p style="line-height: 1.8; font-size: 1.1rem;">
                Hingga saat ini, kami terus berkomitmen untuk memberikan layanan terbaik di bidang advertising, 
                pembuatan media promosi seperti baliho, billboard, neon box, videotron, dan berbagai layanan lainnya.
            </p>
            <p style="line-height: 1.8; font-size: 1.1rem;">
                Kami percaya bahwa kepercayaan pelanggan adalah pondasi utama yang membuat 
                CV. Ramanisa White Media Promosindo tetap bertahan dan berkembang hingga hari ini.
            </p>
        </div>

    </div>
</section>
<section class="py-5" style="background-color: #f8f9fa; width: 100vw;">
    <div class="container-fluid text-center px-5">
        <h2 class="mb-4 fw-bold text-uppercase">Galeri Baliho & Billboard</h2>

        <div class="d-flex flex-wrap justify-content-center gap-4">
            @for ($i = 1; $i <= 6; $i++)
                <div class="gallery-item" 
                     style="
                        flex: 0 0 calc(33.333% - 20px); 
                        max-width: calc(33.333% - 20px); 
                        aspect-ratio: 4/3;
                        overflow: hidden;
                        border-radius: 12px;
                        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                        background-color: #fff;
                     ">
                    <img src="{{ url('images/gambar/gambar' . $i . '.png') }}" 
                         class="img-fluid w-100 h-100" 
                         style="object-fit: cover;" 
                         alt="gambar{{ $i }}">
                </div>
            @endfor
        </div>
    </div>
</section>

<section id="klien" class="py-5" style="background-color: #f8f9fa; width: 100vw;">
    <div class="container text-center">
        <h2 class="fw-bold mb-4 text-uppercase">KLIEN KAMI</h2>
        <p class="text-center mb-5">Kami dipercaya oleh berbagai perusahaan ternama dari berbagai industri.</p>

        <div class="text-center">
            <img src="{{ url('images/klien.png') }}" 
                 alt="Klien Kami" 
                 class="img-fluid rounded shadow" 
                 style="width: 100%; max-width: 1200px;">
        </div>
    </div>
</section>

<section id="lokasi" class="section bg-light">
    <div class="container">
        <h2 class="fw-bold mb-4 text-start">LOKASI</h2>
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