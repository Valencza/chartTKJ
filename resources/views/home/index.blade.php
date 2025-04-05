@extends('home.layouts.app')

@section('content')

<main class="main">
  <!-- Hero Section Start -->
  <section id="hero" class="hero section">
    <div class="container" data-aos-delay="100">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="hero-content" data-aos-delay="200">
            <div class="company-badge mb-4 align-items-center">
              <i class="bi bi-bar-chart-fill me-2"></i>Point of Sales Digital
            </div>
            <h1 class="mb-3 fs-1">
              Sistem Point Of Sales <br class="responsive-br"> yang Mudah dan Efisien
            </h1>
            <p class="mb-4 mb-md-5 desc">
              Sistem point of sales yang dirancang khusus untuk <br class="responsive-br"> mempermudah pencatatan transaksi, laporan penjualan, <br class="responsive-br"> dan pengelolaan stok dengan lebih efisien.
            </p>
            <div class="hero-buttons mb-3">
              <a href="#features" class="btn btn-primary me-0 me-sm-2 mx-1">Coba Sekarang</a>
              <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8"
                class="btn btn-link mt-2 mt-sm-0 glightbox">
                <i class="bi bi-play-circle me-1"></i>
                Pelajari Lebih Lanjut
              </a>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="hero-image" data-aos-delay="300">
            <img src="{{asset ('assets/user/img/digireads-assets/hero-il.svg') }}" alt="Hero Image"
              class="img-fluid">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- Mengapa Kami Start -->
  <section id="mengapa-kami" class="features-cards section">
    <div class="container">
      <div class="row gy-4">
        <div class="col-12 text-center">
          <h1 class="fs-3 mt-lg-3 mt-0 heading">Mengapa Memilih Kami</h1>
          <p class="mb-4 pt-1 sub-heading text-secondary">Platform untuk mengelola transaksi dan bisnis dengan cepat & mudah.</p>
        </div>
        <div class="col-xl-3 col-md-6" data-aos-delay="50">
          <div class="feature-box orange">
            <i class="bi bi-file-earmark-text rounded-pill"></i>
            <h4>Laporan Keuangan</h4>
            <p>Monitor semua pendapatan dan pengeluaran bisnis dengan laporan yang lengkap dan akurat.</p>
          </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos-delay="200">
          <div class="feature-box blue">
            <i class="bi bi-file-bar-graph rounded-pill"></i>
            <h4>Tracking Progress</h4>
            <p>Melacak status layanan kebutuhan barang atau jasa secara real-time dengan mudah dan cepat.</p>
          </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos-delay="350">
          <div class="feature-box green">
            <i class="bi bi-clipboard-check rounded-pill"></i>
            <h4>Manajemen Layanan</h4>
            <p>Atur dan optimalkan pelayanan barang atau jasa untuk memenuhi kebutuhan para pelanggan.</p>
          </div>
        </div>

        <div class="col-xl-3 col-md-6" data-aos-delay="500">
          <div class="feature-box red">
            <i class="bi bi-person-check rounded-pill"></i>
            <h4>Hemat Waktu</h4>
            <p>Mengoptimalkan waktu dengan layanan platform kami yang mudah, cepat dan mudah digunakan.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Mengapa Kami End-->

  <!-- Layanan kami Start -->
  <section id="Layanan-kami" class="Layanan-kami section light-background">
    <div class="container my-3">
      <div class="col-12 mb-4 text-center">
        <h1 class="fs-3 mt-0">Layanan Kami</h1>
        <p class="mb-5 pt-1 text-secondary">
          Temukan fitur-fitur yang membantu Anda di platform kami.
        </p>
      </div>
      <div id="LayananCarousel" class="carousel slide custom-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">
          <!-- Slide 1 -->
          <div class="carousel-item active">
            <div class="row g-4">
              <!-- Card 1 -->
              <div class="col-lg-4 col-md-6" data-aos-delay="50">
                <div class="Layanan-item">
                  <img src="{{asset ('assets/user/img/digireads-assets/pembelian.svg') }}" alt="Fitur Pembelian">
                  <h5>Pembelian</h5>
                  <p class="text-center">
                    Mempermudah Anda dalam melakukan pembelian barang dengan fitur yang terintegrasi dengan baik.
                  </p>
                </div>
              </div>
              <!-- Card 2 -->
              <div class="col-lg-4 col-md-6" data-aos-delay="200">
                <div class="Layanan-item">
                  <img src="{{asset ('assets/user/img/digireads-assets/i 6.svg') }}" alt="Tracking Progress Service">
                  <h5>Tracking Progress</h5>
                  <p class="text-center">
                    Lacak status perbaikan barang dengan fitur tracking kami. Anda akan mendapatkan update terbaru.
                  </p>
                </div>
              </div>
              <!-- Card 3 -->
              <div class="col-lg-4 col-md-6" data-aos-delay="350">
                <div class="Layanan-item">
                  <img src="{{asset ('assets/user/img/digireads-assets/transaksi.svg') }}" alt="Transaksi">
                  <h5>Transaksi</h5>
                  <p class="text-center">
                    transaksi yang mudah dan efisien dengan fitur POS kami.Transaksi jadi lebih cepat dan akurat.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!-- Slide 2 -->
          <div class="carousel-item">
            <div class="row g-4">
              <!-- Card 4 -->
              <div class="col-lg-4 col-md-6" data-aos-delay="50">
                <div class="Layanan-item">
                  <img src="{{asset ('assets/user/img/digireads-assets/lapkeu.svg') }}" alt="Laporan Keuangan">
                  <h5>Laporan Keuangan</h5>
                  <p class="text-center">
                    Mengelola Laporan keuangan dengan detail dan terstruktur dengan data-data yang akurat.
                  </p>
                </div>
              </div>
              <!-- Card 5 -->
              <div class="col-lg-4 col-md-6" data-aos-delay="200">
                <div class="Layanan-item">
                  <img src="{{asset ('assets/user/img/digireads-assets/customer.svg') }}" alt="Manajemen Pelanggan">
                  <h5>Manajemen Pelanggan</h5>
                  <p class="text-center">
                    Kelola data pelanggan dengan mudah dan akurat. Dengan sistem yang dapat diakses kapan saja.
                  </p>
                </div>
              </div>
              <!-- Card 6 -->
              <div class="col-lg-4 col-md-6" data-aos-delay="350">
                <div class="Layanan-item">
                  <img src="{{asset ('assets/user/img/digireads-assets/stok.svg') }}" alt="Manajemen Stok">
                  <h5>Manajemen Stok</h5>
                  <p class="text-center">
                    Atur stok barang secara real-time. Stok barang dapat dipantau dengan mudah setiap saat.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#LayananCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#LayananCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>
  <!-- Layanan kami End -->

  <!-- cta start -->
  <section id=" cta about" class=" cta about section">

    <div class="container">

      <div class="row gy-4 align-items-center justify-content-between">

        <div class="col-lg-5 col-md-12 text-center" data-aos-delay="200">
          <h2 class="about-title">Yuk Langsung <span style="color:  #007BFF; ">Daftar</span> di <br class="d-lg-block d-none"> Platform Kami Sekarang</h2>
          <p class="about-description text-secondary">
            Dapatkan kemudahan mengatur transaksi, laporan penjualan, dan stok barang dalam satu sistem.
            Bergabunglah bersama kami sekarang dan rasakan manfaatnya!</p>
          <a class="btn btn-primary btn-1 rounded-pill text-white"
            href="{{route ('register') }}" role="button">Daftar Sekarang</a>
        </div>

        <div class="col-lg-6 col-md-12" data-aos-delay="300">
          <div class="image-wrapper">
            <div class="images position-relative" data-aos-delay="400">
              <img src="{{asset ('assets/user/img/digireads-assets/cta-il.svg') }}" alt="cta-image" class="img-fluid main-image rounded-4">
            </div>
          </div>
        </div>
      </div>

    </div>

  </section>
  <!-- cta end -->

  @php
  use App\Models\UlasanUser;

  // Ambil semua ulasan user beserta relasi user-nya
  $ulasan = UlasanUser::with('user')->get();
  @endphp

  @if($ulasan->count() > 0)
  <!-- Testimoni Start -->
  <section id="testimonials" class="testimonials section light-background">
    <div class="container my-3">
      <div class="col-12 mb-4 text-center">
        <h1 class="fs-3 mt-0 heading">Ulasan Pengguna</h1>
        <p class="mb-5 pt-1 sub-heading text-secondary">Pengalaman pengguna dalam menggunakan Platform Kami</p>
      </div>

      <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          @foreach ($ulasan->chunk(3) as $chunkIndex => $ulasanChunk)
          <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
            <div class="row g-4">
              @foreach ($ulasanChunk as $ul)
              <div class="col-lg-4 col-md-6">
                <div class="testimonial-item">
                  <img src="{{ $ul->user && $ul->user->gambar ? asset($ul->user->gambar) : asset('assets/user/img/default-avatar.png') }}"
                    onerror="this.src='{{ asset('assets/user/img/default-avatar.png') }}';"
                    class="testimonial-img" alt="{{ $ul->user->name ?? 'Pengguna' }}">
                  <h3>{{ $ul->user->name ?? 'Pengguna' }}</h3>
                  <div class="stars text-warning">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div><br>
                  <p class="testimonial-description">
                    <i class="bi bi-quote quote-icon-left"></i>
                    "{{ $ul->message }}"
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>
  @else
  <p class="text-center text-muted">Belum ada ulasan pengguna.</p>
  @endif

  <!-- Testimoni End -->

  <!-- Contact Section Start -->
  <section id="contact" class="contact section">

    <!-- Section Title -->
    <div class="container section-title">
      <h1 class="fs-3  mt-0 heading" style="font-weight: 700; font-family: 'Poppins';">Kontak Kami</h1>
      <p class="mb-2 pt-1 sub-heading text-secondary" style="font-weight: 500;">Hubungi kami untuk informasi lebih lanjut atau bantuan terkait layanan kami.
    </div>
    <!-- End Section Title -->

    <div class="container" data-aos-delay="100">

      <div class="row g-4 g-lg-5">
        <div class="col-lg-5">
          <div class="info-box" data-aos-delay="200">
            <h1 class="fs-4 mt-0 heading text-white" style="font-weight: 700; font-family: 'Poppins';">Info Kontak</h1>
            <p class="mb-xxl-5 mb-lg-4 mb-5 pt-1 sub-heading text-white" style="font-weight: 500;">
              Detail kontak kami untuk mendapatkan informasi lebih lanjut terkait layanan yang kami tawarkan.
            </p>

            <div class="info-item mb-md-4 mb-4" data-aos-delay="300">
              <div class="icon-box">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="content">
                <h4>Lokasi Kami</h4>
                <p>Jalan Tanimbar No 108</p>
                <p>Malang, Jawa Timur</p>
              </div>
            </div>

            <div class="info-item mb-md-4 mb-4" data-aos-delay="400">
              <div class="icon-box">
                <i class="bi bi-telephone"></i>
              </div>
              <div class="content">
                <h4>Nomor Telepon</h4>
                <p>+1 5589 55488 55</p>
                <p>+1 6678 254445 41</p>
              </div>
            </div>

            <div class="info-item" data-aos-delay="500">
              <div class="icon-box">
                <i class="bi bi-envelope"></i>
              </div>
              <div class="content">
                <h4>Alamat Email</h4>
                <p>charttkj@gmail.com</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-7">
          <div class="card p-4 ">
            <div class="contact-form" data-aos-delay="300">
              <h1 class="fs-4 mt-0 heading" style="font-weight: 700; font-family: 'Poppins';">Form Kontak</h1>
              <p class="mb-5 pt-1 sub-heading" style="font-weight: 500;">
                Silakan isi formulir di bawah ini untuk memberikan pesan atau ulasan Anda kepada kami. Kami akan segera menanggapi!
              </p>

              <form action="{{route ('storeUlasanUser') }}" method="POST" data-aos-delay="200">
                @csrf
                <div class="row gy-4">
                  <!-- Nama -->
                  <div class="col-md-6">
                    <input type="text" name="nama" class="form-control" value="{{ Auth::user()->nama ?? 'Tidak ada nama' }}" readonly>
                  </div>

                  <!-- Email -->
                  <div class="col-md-6">
                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email ?? 'Tidak ada email' }}" readonly>
                  </div>

                  <!-- Pesan -->
                  <div class="col-12">
                    <textarea class="form-control" name="message" rows="4" placeholder="Pesan atau Ulasan Anda" required autocomplete="off"></textarea>
                  </div>

                  <!-- Tombol Submit -->
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>

  </section>
  <!-- Contact Section End -->

</main>


@endsection