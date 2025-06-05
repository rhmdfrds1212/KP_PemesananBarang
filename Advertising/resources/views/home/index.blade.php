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

    .transition-all {
        transition: transform 0.5s ease;
    }
    
</style>

{{-- Hero Section --}}
<section class="hero">
    <div class="container">
        <h1 class="display-4 fw-bold">Solusi Periklanan Advertising Terbaik</h1>
        <p class="lead">Tingkatkan visibilitas brand Anda dengan strategi pemasaran modern dan efektif.</p>
        <a href="#layanan" class="btn btn-success btn-lg mt-4">Lihat Layanan Kami</a>
    </div>
</section>

{{-- Alur Pemesanan --}}
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">Cara Memesan Layanan Kami</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="p-4 shadow-sm bg-white rounded">
                    <span class="badge bg-success fs-5 mb-2">1</span>
                    <h6 class="fw-bold">Hubungi Kami</h6>
                    <p class="text-muted">Konsultasikan kebutuhan Anda lewat WhatsApp atau Telepon.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 shadow-sm bg-white rounded">
                    <span class="badge bg-success fs-5 mb-2">2</span>
                    <h6 class="fw-bold">Pilih Lokasi</h6>
                    <p class="text-muted">Tentukan titik strategis yang ingin Anda pasangi iklan.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 shadow-sm bg-white rounded">
                    <span class="badge bg-success fs-5 mb-2">3</span>
                    <h6 class="fw-bold">Desain & Cetak</h6>
                    <p class="text-muted">Kami bantu proses desain dan percetakan profesional.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 shadow-sm bg-white rounded">
                    <span class="badge bg-success fs-5 mb-2">4</span>
                    <h6 class="fw-bold">Pemasangan</h6>
                    <p class="text-muted">Iklan Anda langsung dipasang sesuai jadwal yang disepakati.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Galeri Gambar --}}
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

{{-- Layanan --}}
<section id="layanan" class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">Layanan Iklan Fisik Profesional</h2>
        <p class="mb-5 text-muted">Kami membantu bisnis Anda tampil mencolok di dunia nyata melalui media iklan luar ruang yang menarik perhatian</p>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-lg p-4">
                    <div class="service-icon mb-3 text-primary">
                        <i class="bi bi-easel-fill display-5"></i>
                    </div>
                    <h5 class="card-title fw-semibold">Pemasangan Baliho & Billboard</h5>
                    <p class="card-text">Jangkau ribuan orang setiap hari dengan baliho dan billboard di lokasi strategis kota Anda.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-lg p-4">
                    <div class="service-icon mb-3 text-success">
                        <i class="bi bi-lightbulb-fill display-5"></i>
                    </div>
                    <h5 class="card-title fw-semibold">Pembuatan Neon Box</h5>
                    <p class="card-text">Desain neon box eksklusif dengan pencahayaan maksimal untuk bisnis Anda tetap terlihat siang dan malam.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-lg p-4">
                    <div class="service-icon mb-3 text-danger">
                        <i class="bi bi-tools display-5"></i>
                    </div>
                    <h5 class="card-title fw-semibold">Desain & Percetakan</h5>
                    <p class="card-text">Layanan desain kreatif dan cetak berkualitas tinggi untuk banner, spanduk, dan media promosi lainnya.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Alasan Memilih Kami --}}
<section class="py-5 bg-white border-top">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">Kenapa Memilih Kami?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-4 h-100 shadow-sm rounded bg-light">
                    <i class="bi bi-geo-alt-fill display-5 text-primary mb-3"></i>
                    <h5 class="fw-semibold">Lokasi Strategis</h5>
                    <p class="text-muted">Kami menyediakan titik pemasangan di area dengan lalu lintas tinggi dan visibilitas maksimal.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 h-100 shadow-sm rounded bg-light">
                    <i class="bi bi-star-fill display-5 text-warning mb-3"></i>
                    <h5 class="fw-semibold">Kualitas Terjamin</h5>
                    <p class="text-muted">Material tahan cuaca dan proses pemasangan profesional menjamin ketahanan jangka panjang.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-4 h-100 shadow-sm rounded bg-light">
                    <i class="bi bi-clock-fill display-5 text-success mb-3"></i>
                    <h5 class="fw-semibold">Tepat Waktu</h5>
                    <p class="text-muted">Kami berkomitmen menyelesaikan pekerjaan sesuai jadwal yang disepakati tanpa mengurangi kualitas.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Portofolio Kami --}}
<section class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4 fw-bold">Contoh Proyek Kami</h2>
        <p class="mb-5 text-muted">Berikut adalah beberapa proyek pemasangan media luar ruang yang telah kami kerjakan</p>
        <div class="row g-4">
            <div class="col-md-4">
                <img src="/images/portofolio1.jpg" class="img-fluid rounded shadow-sm" alt="Baliho Djarum Istimewa">
                <p class="mt-2 fw-medium">Baliho - Djarum Istimewa</p>
            </div>
            <div class="col-md-4">
                <img src="/images/portofolio2.png" class="img-fluid rounded shadow-sm" alt="Neonbox">
                <p class="mt-2 fw-medium">Neonbox - Restoran</p>
            </div>
            <div class="col-md-4">
                <img src="/images/portofolio3.jpg" class="img-fluid rounded shadow-sm" alt="Billboard Walikota">
                <p class="mt-2 fw-medium">Billboard - Walikota</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="cta py-5 bg-success text-white">
    <div class="container text-center">
        <h2 class="mb-3 fw-bold">Ingin Usaha Anda Lebih Terlihat?</h2>
        <p class="lead mb-4">Hubungi kami untuk konsultasi gratis pemasangan baliho, billboard, atau neon box di lokasi strategis!</p>
        <a href="{{ route('tentangkami') }}" class="btn btn-light btn-lg rounded-pill">Pelajari Tentang Kami</a>
    </div>
</section>


{{-- Footer --}}
<footer>
    <div class="container">
        <p>&copy; {{ date('Y') }} CV. Ramanisa White Media Promosindo. All rights reserved.</p>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const gallery = document.getElementById('gallery');
        const items = gallery.querySelectorAll('.gallery-item');
        const itemsPerScroll = 3;
        const itemWidth = items[0].offsetWidth + 10;

        let currentIndex = 0;
        const maxIndex = Math.ceil(items.length / itemsPerScroll) - 1;

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentIndex < maxIndex) {
                currentIndex++;
                gallery.style.transform = `translateX(-${currentIndex * itemsPerScroll * itemWidth}px)`;
            }
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                gallery.style.transform = `translateX(-${currentIndex * itemsPerScroll * itemWidth}px)`;
            }
        });
    });
</script>
@endsection
