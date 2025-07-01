@extends('layout.main')

@section('content')

<style>
    body {
        background-color: #ffffff;
        color: #000;
    }
    .produk-hero {
        padding: 60px 0;
    }
    .produk-title {
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        letter-spacing: 2px;
        color: #333;
    }
    .produk-slide {
        position: relative;
        max-width: 90%;
        margin: 0 auto;
        overflow: hidden;
        background-color: rgba(255, 219, 100, 0.97);
        color: #000;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        background-color: rgba(255, 219, 100, 0.97);
        word-break: break-word;

    }
    .slide {
        display: none;
        align-items: center;
    }
    .slide.active {
        display: flex;
    }
    .slide img {
        width: 50%;
        border-radius: 10px 0 0 10px;
        object-fit: cover;
    }
    .slide .info {
        width: 50%;
        background-color: rgba(255, 220, 100, 0.4);
        padding: 40px;
        border-radius: 0 10px 10px 0;
    }
    .slide .info h3 {
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .slide .info ul {
        list-style: disc;
        padding-left: 20px;
    }
    .arrow {
        cursor: pointer;
        position: absolute;
        top: 50%;
        padding: 10px 15px;
        background-color: rgba(0,0,0,0.7);
        color: white;
        border-radius: 5px;
        transform: translateY(-50%);
        transition: background-color 0.3s;
    }
    .arrow:hover {
        background-color: rgba(0,0,0,0.9);
    }
    .arrow.left {
        left: 10px;
    }
    .arrow.right {
        right: 10px;
    }
    .kategori-nav {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    .kategori-nav a {
        padding: 8px 20px;
        border-radius: 30px;
        background-color: #f0f0f0;
        color: #333;
        text-decoration: none;
        font-weight: 600;
        border: 2px solid transparent;
        transition: all 0.3s;
    }
    .kategori-nav a.active,
    .kategori-nav a:hover {
        background-color: #6ce368;
        color: #000;
        border-color: #6ce368;
    }
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

<div class="produk-hero">
    <div class="container">

        <h2 class="produk-title">PRODUK KAMI</h2>
        @if(Auth::check() && Auth::user()->role === 'a')
            <div class="text-end mb-3">
                <a href="{{ route('produk.create') }}" class="btn btn-success">
                    + Tambah Produk
                </a>
            </div>
            @endif
        <div class="produk-slide">
            @foreach ($produks as $index => $produk)
            <div class="slide {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ $produk->foto ? asset('upload/produk/' . $produk->foto) : 'https://via.placeholder.com/600x400' }}" alt="{{ $produk->nama }}">
                <div class="info">
                    <h3>{{ strtoupper($produk->nama) }}</h3>
                    <p><strong>Kategori:</strong> {{ $produk->kategori }}</p>
                    <p><strong>Deskripsi:</strong> {{ $produk->deskripsi }}</p>
                    <hr>
                    <p><strong>Tersedia dalam ukuran:</strong></p>
                    <ul>
                        @php
                            $kategori = strtolower(trim($produk->kategori));
                        @endphp

                        @if($kategori === 'baliho')
                            <li>4 x 6 M Vertical</li>
                            <li>8 x 4 M Horizontal</li>
                        @elseif($kategori === 'videotron')
                            <li>2 x 4 M Horizontal</li>
                            <li>4 x 6 M Vertical</li>
                        @elseif($kategori === 'billboard')
                            <li>5 x 10 M Vertical</li>
                            <li>6 x 12 M Vertical</li>
                        @else
                            <li>Ukuran custom sesuai kebutuhan</li>
                        @endif
                    </ul>
                    <div class="mt-3">
                        <a href="{{ route('detail_produks.show', $produk->id) }}" class="btn btn-dark">Lihat Detail</a>
                        @if (Auth::check() && Auth::user()->role === 'a')
                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus produk?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Hapus</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

            <div class="arrow left" onclick="prevSlide()">&#10094;</div>
            <div class="arrow right" onclick="nextSlide()">&#10095;</div>
        </div>

    </div>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }
</script>

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