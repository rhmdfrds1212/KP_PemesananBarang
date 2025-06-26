@extends('layout.main')

@section('content')

<style>
    html {
        scroll-behavior: smooth;
    }

    .hero {
        background: url('{{ url('images/iklan.png') }}') center center/cover no-repeat;
        width: 100%;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        position: relative;
    }

    .hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.6);
    }

    .hero .content {
        position: relative;
        z-index: 2;
    }

    .hero h1 {
        font-size: 4rem;
        font-weight: 900;
        line-height: 1.2;
    }

    .hero p {
        font-size: 1.5rem;
        margin-top: 1rem;
    }

    .hero .btn {
        margin-top: 2rem;
        padding: 0.75rem 2rem;
        border-radius: 50px;
    }

    .section {
        padding: 100px 0;
    }

    .dark-section {
        background-color: #111;
        color: white;
    }

    footer {
        background-color: #111;
        color: #aaa;
        padding: 30px 0;
        text-align: center;
    }

    nav .nav-link.active, nav .nav-link:hover {
        color: #fcb900 !important;
    }
</style>

<!-- Hero -->
<section id="home" class="hero">
    <div class="content">
        <h1 class="mb-3">RAMANISA WHITE<br> MEDIA PROMOSINDO</h1>
        <p class="fst-italic">WE Design, WE Create, WE Build, WE Maintain, WE Communicate</p>
        <a href="#cerita" class="btn btn-success">Lihat Selengkapnya</a>
    </div>
</section>

<!-- Cerita Kami -->
<section id="cerita" class="section bg-success text-dark">
    <div class="container">
        <div class="row align-items-center">
            <!-- Judul di Kiri -->
            <div class="col-md-6 mb-4 mb-md-0 ps-5">
                <h2 class="fw-bold display-4">CERITA <br>KAMI</h2>
            </div>

            <!-- Deskripsi di Kanan -->
            <div class="col-md-6">
                <p>
                    Berdiri di kota Palembang, Sumatera Selatan, pada tahun 1985 oleh Alm. Bapak Heru Arttans. 
                    Selama lebih dari 35 tahun, <strong>CV. Ramanisa White Media Promosindo</strong> terus berkomitmen memberikan layanan terbaik untuk klien-klien kami.
                </p>
                <p>
                    Kami adalah pelopor perusahaan advertising di Palembang yang memperkenalkan media <strong>Neon Sign</strong>.
                    Dengan semangat tinggi dan dedikasi, kami telah memproduksi media iklan indoor dan outdoor untuk lebih dari <strong>50 merek</strong> berbeda.
                </p>
                <p>
                    Kami juga dipercaya menjadi mitra dalam event berskala nasional dan internasional seperti 
                    <strong>PON (2004)</strong>, <strong>SEA Games (2011)</strong>, dan <strong>International Surya Dragon Boat (Padang)</strong>.
                </p>
            </div>
        </div>
    </div>
</section>



<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4">Galeri Baliho & Billboard</h2>
        <div class="position-relative">
            <div id="galleryWrapper" class="overflow-hidden">
                <div id="gallery" class="d-flex transition-all" style="gap: 10px;">
                    @for ($i = 1; $i <= 18; $i++)
                        <div class="gallery-item" style="flex: 0 0 calc(33.333% - 10px); max-width: calc(33.333% - 10px);">
                            <img src="{{ url('images/gambar/gambar' . $i . '.jpg') }}" class="img-fluid rounded shadow" alt="gambar{{ $i }}">
                        </div>
                    @endfor
                </div>
            </div>
            <button id="prevBtn" class="btn btn-primary position-absolute top-50 start-0 translate-middle-y z-3">
                <i class="bi bi-arrow-left-circle-fill"></i>
            </button>
            <button id="nextBtn" class="btn btn-primary position-absolute top-50 end-0 translate-middle-y z-3">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </button>
        </div>
    </div>
</section>

<!-- Klien Kami -->
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

<!-- Lokasi Kami -->
<section id="lokasi" class="section bg-light">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">LOKASI KAMI</h2>
        <p class="mb-4">
            Komplek TOP 100, Jl. Cengho 1 Blok A7 No.27, 15 Ulu, Kecamatan Seberang Ulu I, Kota Palembang, Sumatera Selatan 30134
        </p>
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

<!-- Footer -->
<footer class="bg-success text-white pt-5 pb-3">
    <div class="container">
        <div class="row text-start">
            <div class="col-md-4 mb-4">
                <img src="{{ url('images/logo.png') }}" alt="Logo" width="180">
                <p class="mt-3">&copy; 2025 by CV. Ramanisa White Media Promosindo</p>
            </div>

            <!-- Jam Operasi -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">JAM OPERASI</h5>
                <p class="m-0">Senin – Sabtu:</p>
                <p class="m-0">08:00 AM sampai 17:00 PM</p>
                <p class="m-0">Minggu: Tutup</p>
            </div>

            <!-- Kontak -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3">HUBUNGI KAMI</h5>
                <p class="mb-1">Jl.Pangeran ratu, Komplek TOP100 blok, A7-27 jakabaring - palembang.  Sumatra Selatan. 30134</p>
                <p class="mb-1">Mail: <a href="mailto:rawhite.adv@gmail.com" class="text-warning">rawhite.adv@gmail.com</a></p>
                <p class="mb-1"><strong>Telp :</strong> <a href="tel:+628127878578" class="text-warning">+62 812-7878-578</a></p>
                <p class="mb-1"><strong>Whatsapp:</strong> <a href="https://wa.me/628127878578" class="text-warning">+62 812-7878-578</a></p>
            </div>
        </div>
    </div>
</footer>

@endsection
