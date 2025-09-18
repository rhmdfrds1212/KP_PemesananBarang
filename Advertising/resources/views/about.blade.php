@extends('layout.main')

@section('title', 'Hubungi Kami')
@section('content')

<style>
    body {
        background-color: #fefefe;
        font-family: 'Poppins', sans-serif;
        color: #333;
    }

    .contact-wrapper {
        padding: 80px 0;
    }

    .contact-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .contact-subtitle {
        text-align: center;
        font-size: 1rem;
        color: #666;
        margin-bottom: 40px;
    }

    .contact-box {
        text-align: center;
        padding: 40px 20px;
        border-radius: 12px;
        background-color: #fff;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        transition: 0.3s ease;
    }

    .contact-box:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
    }

    .icon-circle {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #43a047;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px auto;
        font-size: 24px;
    }

    .contact-box p {
        margin-bottom: 8px;
    }

    .btn-whatsapp {
        background-color: #ffc107;
        color: #000;
        font-weight: bold;
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        margin-top: 15px;
        text-transform: uppercase;
        transition: 0.3s ease;
    }

    .btn-whatsapp:hover {
        background-color: #e0a800;
    }

    .qr-section {
        text-align: center;
        margin-top: 60px;
    }

    .qr-section img {
        max-width: 180px;
        margin-bottom: 10px;
    }

    .qr-section p {
        font-weight: 600;
        letter-spacing: 1px;
        color: #444;
        margin-top: 8px;
        text-transform: uppercase;
    }
    footer {
        background-color: #ffffff;
        color: #bbb;
        padding: 60px 0 30px 0;
        border-top: 1px solid #c7c7c7;
    }

    footer h5 {
        color: #000000;
        margin-bottom: 20px;
    }

    footer p, footer a {
        color: #000000;
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
        width: 300px;
        max-width: 100%;
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

    @media (max-width: 768px) {
        .contact-box {
            margin-bottom: 30px;
        }
    }
</style>

  <div class="container contact-wrapper">
      <h2 class="contact-title">Hubungi Kami</h2>
      <p class="contact-subtitle">Kami siap membantu kebutuhan promosi Anda</p>

      <div class="row justify-content-center">
      <div class="col-md-4 d-flex">
          <div class="contact-box flex-fill">
              <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
              <p><strong>Alamat:</strong></p>
              <p>Jl. Pangeran Ratu, Komplek TOP100 Blok A7-27</p>
              <p>Jakabaring - Palembang, Sumsel 30134</p>
          </div>
      </div>

      <div class="col-md-4 d-flex">
          <div class="contact-box flex-fill">
              <div class="icon-circle"><i class="fas fa-envelope"></i></div>
              <p><strong>Email:</strong></p>
              <p><a href="mailto:rawhite.adv@gmail.com">rawhite.adv@gmail.com</a></p>
              <p><strong>Telepon:</strong></p>
              <p><a href="tel:+6281367296800">+62 813-6729-6800</a></p>
          </div>
      </div>

      <div class="col-md-4 d-flex">
          <div class="contact-box flex-fill d-flex flex-column justify-content-between">
              <div>
                  <div class="icon-circle"><i class="fab fa-whatsapp"></i></div>
                  <p><strong>WhatsApp:</strong></p>
                  <p><a href="https://wa.me/6281367296800">+62 813-6729-6800</a></p>
              </div>
              <div>
                  <a href="https://wa.me/628127878578" target="_blank">
                      <button class="btn-whatsapp">Chat via WhatsApp</button>
                  </a>
              </div>
          </div>
      </div>
  </div>

    <div class="qr-section">
        <p>Atau scan QR berikut:</p>
        <img src="{{ url('images/qrwa.png') }}" alt="QR WhatsApp">
        <p>Scan Me!</p>
    </div>
</div>

{{-- Pastikan kamu juga punya Font Awesome di layout --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<footer>
    <div class="container">
        <div class="row text-start">
            <div class="col-md-4 mb-4">
                <img src="{{ url('images/logo-remove.png') }}" alt="Logo" class="logo-footer">
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
