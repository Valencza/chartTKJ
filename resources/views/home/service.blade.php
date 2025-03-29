@extends('home.layouts.app')

@section('content')

<style>
    .features-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .features-list li {
        display: flex;
        padding: 10px;
    }

    .features-list i {
        margin-right: 10px;
        /* Jarak antara ikon dan teks */
        font-size: 1.2rem;
    }

    /* Mengatur layout teks dan harga */
    .ker {
        display: grid;
        grid-template-columns: 1fr auto;
        /* Teks - Harga */
        width: 100%;
        align-items: center;
        gap: 10px;
    }

    .kerusakan {
        flex-grow: 1;
        min-width: 200px;
        /* Mencegah teks terlalu panjang */
        word-wrap: break-word;
    }

    .harga {
        font-weight: bold;
        white-space: nowrap;
        /* Mencegah harga turun */
        text-align: right;
    }

    /* Responsive untuk layar kecil */
    @media (max-width: 470px) {
        .features-list li {
            display: flex;
        }

        .ker {
            display: block;
        }

        .harga {
            text-align: left;
            margin-top: 5px;
            display: block;
        }
    }


    .hero-servis .container i {
        font-size: 1.8rem;
    }

    .feature-card {
        background: #fff;
        padding: 20px;
    }

    .feature-card:hover {
        transform: translateY(-15px);
    }

    .feature-number {
        font-size: 24px;
        font-weight: bold;
        width: 50px;
        height: 50px;
        line-height: 50px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #0d83fd;
        background-color: #e9f9ff;
    }


    .feature-card h4 {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .feature-card p {
        font-size: 14px;
        color: #555;
    }

    .feature-card .row {
        display: flex;
        flex-wrap: wrap;
    }

    .feature-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* Menyamakan tinggi */
        height: 100%;
    }

    .feature-card {
        padding: 20px;
        border-radius: 19px;
        box-shadow: 2px 7px 12px rgba(91, 91, 91, 0.083);
        transition: transform 0.3s ease-in-out,
            box-shadow 0.3s ease-in-out;
    }

    .custom-btn {
        padding: 0px 35px;
        font-weight: 500;
        box-shadow: 0 4px 8px rgba(100, 100, 100, 0.1);
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .custom-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(100, 100, 100, 0.2);
    }

    .pricing-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        /* Pastikan kartu memiliki tinggi penuh */
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .card-content {
        flex: 1;
        /* Memastikan konten memenuhi ruang sebelum tombol */
    }

    .features-list {
        list-style: none;
        padding: 0;
    }

    .features-list li {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
    }

    .features-list i {
        margin-right: 10px;
    }

    .btn-block {
        width: 100%;
        /* Tombol memenuhi lebar card */
        text-align: center;
    }

    .modal-body {
        max-height: 75vh;
    }

    .modal-body::-webkit-scrollbar {
        width: 8px;
        opacity: 0;
        /* Scrollbar akan hilang saat tidak digunakan */
        transition: opacity 0.3s ease-in-out;
    }

    .modal-body:hover::-webkit-scrollbar {
        opacity: 1;
        /* Muncul saat di-hover */
    }

    .modal-body::-webkit-scrollbar-thumb {
        background: rgba(7, 124, 248, 0.8);
        border-radius: 10px;
    }

    .modal-body::-webkit-scrollbar-track {
        background: #f8f9fa;
    }


    .pricing .pricing-card {
        height: 100%;
        padding: 2rem;
        background: var(--surface-color);
        border-radius: 1rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .pricing .pricing-card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .pricing .pricing-card.popular {
        background: var(--accent-color);
        color: var(--contrast-color);
    }

    .pricing .pricing-card.popular h3,
    .pricing .pricing-card.popular h4 {
        color: var(--contrast-color);
    }

    .pricing .pricing-card.popular .price .currency,
    .pricing .pricing-card.popular .price .amount,
    .pricing .pricing-card.popular .price .period {
        color: var(--contrast-color);
    }

    .pricing .pricing-card.popular .features-list li {
        color: var(--contrast-color);
    }

    .pricing .pricing-card.popular .features-list li i {
        color: var(--contrast-color);
    }

    .pricing .pricing-card.popular .btn-light {
        background: var(--contrast-color);
        color: var(--accent-color);
    }

    .pricing .pricing-card.popular .btn-light:hover {
        background: color-mix(in srgb, var(--contrast-color), transparent 10%);
    }

    .pricing .pricing-card .popular-badge {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: var(--contrast-color);
        color: var(--accent-color);
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.875rem;
        font-weight: 600;
        box-shadow: 0px -2px 10px rgba(0, 0, 0, 0.08);
    }

    .pricing .pricing-card h3 {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .pricing .pricing-card .price {
        margin-bottom: 1.5rem;
    }

    .pricing .pricing-card .price .currency {
        font-size: 1.5rem;
        font-weight: 600;
        vertical-align: top;
        line-height: 1;
    }

    .pricing .pricing-card .price .amount {
        font-size: 3.5rem;
        font-weight: 700;
        line-height: 1;
    }

    .pricing .pricing-card .price .period {
        font-size: 1rem;
        color: color-mix(in srgb, var(--default-color), transparent 40%);
    }

    .pricing .pricing-card .description {
        margin-bottom: 2rem;
        font-size: 0.975rem;
    }

    .pricing .pricing-card h4 {
        font-size: 1.125rem;
        margin-bottom: 1rem;
    }

    .pricing .pricing-card .features-list {
        list-style: none;
        padding: 0;
        margin: 0 0 2rem 0;
    }

    .pricing .pricing-card .btn {
        width: 100%;
        padding: 0.75rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-weight: 500;
        border-radius: 50px;
    }

    .pricing .pricing-card .btn.btn-primary {
        background: var(--accent-color);
        border: none;
        color: var(--contrast-color);
    }

    .pricing .pricing-card .btn.btn-primary:hover {
        background: color-mix(in srgb, var(--accent-color), transparent 15%);
    }

    .card img.img-fluid {
        height: 200px;
        object-fit: cover;
        border-radius: 15px;
    }

    @media screen and (max-width: 990px) {
        .cta .container {
            margin-top: -90px;
        }
    }

    @media screen and (max-width: 452px) {
        .hero-servis .container i {
            font-size: 1.4rem;
        }

        .hero-servis .container h2 {
            font-size: 23px;
        }
    }

    @media screen and (max-width: 470px) {
        .features-list.feature li {
            display: flex;
            flex-direction: column;
        }
    }

    @media screen and (max-width: 375px) {
        .hero-servis .container h2 {
            font-size: 21px;
        }
    }
</style>

<main class="main">
    <!-- Breadcrumbs start -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container mt-5 pt-5">
            <div class="row align-items-center">
                <div class="col-lg-12 mt-4">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route ('index') }}">
                                    <i class="bi bi-house-door icon" style="font-size: 19px;"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route ('service') }}" class=" text-primary">Servis</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumbs end -->

    <!-- hero start -->
    <section id="hero-servis" class="hero-servis" style="margin-top: -40px;">
        <div class="container">
            <div class="col-xxl-5 col-lg-7 col-md-8 col-12" data-aos-delay="30">
                <div class="d-flex align-items-center justify-content-center">
                    <!-- Ikon -->
                    <i class="bi bi-tools rounded-circle me-4 py-3 px-4" style=" color: #007BFF; background-color: #f0f8ff;"></i>

                    <!-- Judul -->
                    <h2 class="about-title fw-bold">
                        Layanan <span style="color:#007BFF;">Servis</span> Barang dan Jasa yang Tersedia
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <!-- hero end -->

    <!-- Features Section -->
    <section id="features" class="features section pt-2">
        <div class="container">

            <div class="d-flex justify-content-center pb-3">

                <ul class="nav nav-tabs" data-aos-delay="100">

                    <li class="nav-item p-1">
                        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                            <h4 class="p-1" style="font-size: 16px;">Servis Barang</h4>
                        </a>
                    </li><!-- End tab nav item -->

                    <li class="nav-item p-1">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                            <h4 class="p-1" style="font-size: 16px;">Servis Jasa</h4>
                        </a><!-- End tab nav item -->
                    </li>
                </ul>

            </div>

            <div class="tab-content" data-aos-delay="300">

                <div class="tab-pane fade active show" id="features-tab-1">
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4" data-aos-delay="50">
                            <div class="feature-card  card-shadow">
                                <div class="feature-number mb-3 orange">1</div>
                                <h4>Konsultasi Kerusakan</h4>
                                <p style="font-weight: 500;">Diskusikan masalah perangkat dengan teknisi untuk mendapatkan solusi awal. Dengan konsultasi, masalah dapat dipahami sebelum tindakan perbaikan dilakukan.</p>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4" data-aos-delay="250">
                            <div class="feature-card  ">
                                <div class="feature-number mb-3 blue">2</div>
                                <h4>Diagnosa & Estimasi</h4>
                                <p style="font-weight: 500;">Teknisi akan memeriksa perangkat untuk mengidentifikasi masalah utama. Setelah itu, estimasi biaya dan waktu pengerjaan akan diberikan kepada pelanggan.</p>
                            </div>
                        </div>

                        <!-- Proses Perbaikan -->
                        <div class="col-xl-3 col-md-6 mb-4" data-aos-delay="450">
                            <div class="feature-card">
                                <div class="feature-number mb-3 green">3</div>
                                <h4>Proses Perbaikan</h4>
                                <p style="font-weight: 500;">Perbaikan dilakukan sesuai hasil diagnosa dengan metode profesional. Teknisi memastikan semua prosedur dilakukan secara efisien agar hasilnya optimal.</p>
                            </div>
                        </div>

                        <!-- Pengujian & Penyelesaian -->
                        <div class="col-xl-3 col-md-6 mb-4" data-aos-delay="650">
                            <div class="feature-card  ">
                                <div class="feature-number mb-3 red">4</div>
                                <h4>Pembayaran</h4>
                                <p style="font-weight: 500;">Setelah perbaikan selesai, perangkat diuji untuk memastikan fungsinya normal. Jika sudah sesuai standar, pelanggan dapat melakukan pembayaran akhir.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- End tab content item -->

                <div class="tab-pane fade" id="features-tab-2">
                    <div class="row">
                        <!-- Pemesanan Jasa -->
                        <div class="col-xl-3 col-md-6 mb-4" data-aos-delay="50">
                            <div class="feature-card  ">
                                <div class="feature-number mb-3 orange">1</div>
                                <h4>Pilih Layanan</h4>
                                <p style="font-weight: 500;">Pilih layanan yang sesuai dengan kebutuhan Anda. Lakukan pemesanan dengan mudah dan praktis langsung melalui platform kami.</p>
                            </div>
                        </div>

                        <!-- Proses Perbaikan -->
                        <div class="col-xl-3 col-md-6 mb-4" data-aos-delay="250">
                            <div class="feature-card  ">
                                <div class="feature-number mb-3 blue">2</div>
                                <h4>Proses Perbaikan</h4>
                                <p style="font-weight: 500;">Teknisi mulai memperbaiki perangkat berdasarkan pesanan. Setiap langkah diperiksa dengan cermat agar hasilnya maksimal.</p>
                            </div>
                        </div>

                        <!-- Tracking Progress -->
                        <div class="col-xl-3 col-md-6 mb-4" data-aos-delay="450">
                            <div class="feature-card  ">
                                <div class="feature-number mb-3 green">3</div>
                                <h4>Tracking Progress</h4>
                                <p style="font-weight: 500;">Pantau status perbaikan perangkat Anda secara real-time. Dapatkan pembaruan berkala untuk memastikan transparansi layanan.</p>
                            </div>
                        </div>

                        <!-- Penyelesaian Layanan -->
                        <div class="col-xl-3 col-md-6 mb-4" data-aos-delay="650">
                            <div class="feature-card  ">
                                <div class="feature-number mb-3 red">4</div>
                                <h4>Pembayaran</h4>
                                <p style="font-weight: 500;">Konfirmasi hasil layanan setelah proses selesai. Pastikan semuanya sesuai sebelum melakukan pembayaran akhir.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- End tab content item -->


            </div>

        </div>

    </section>
    <!-- /Features Section -->

    <!-- cta start -->
    <section id=" cta about" class=" cta about section pt-0">

        <div class="container">

            <div class="row gy-4 align-items-center justify-content-between">
                <div class="col-lg-6 col-md-12" data-aos-delay="340">
                    <div class="image-wrapper">
                        <div class="images position-relative" data-aos-delay="400">
                            <img src="{{asset ('assets/user/img/digireads-assets/cta-il.svg') }}" alt="cta-image" class="img-fluid main-image rounded-4">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 text-center" data-aos-delay="380">
                    <h2 class=fw-bold>Butuh Servis Barang atau Jasa</h2>
                    <p class="text-muted" style="font-weight: 500;">
                        Apakah perangkat elektronik Anda rusak atau membutuhkan jasa pemasangan & konfigurasi ?
                        Kami siap membantu dengan layanan profesional dan harga terjangkau.
                    </p>
                    <div class="cta-buttons pt-3">
                        <a href="#" class="btn btn-primary rounded-pill me-1 mb-2" data-bs-toggle="modal" data-bs-target="#modalServisBarang">Servis Barang</a>
                        <a href="#" class="btn btn-outline-primary py-3 mb-2 rounded-pill ms-1 custom-btn" data-bs-toggle="modal" data-bs-target="#modalServisJasa">Servis Jasa</a>
                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- cta end -->

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section light-background">

        <!-- Section Title -->
        <div class="container section-title">
            <h2>Daftar Harga</h2>
            <p class="text-secondary">Berikut adalah daftar harga servis barang dan jasa</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos-delay="100">
            <div class="row g-4 justify-content-center">

                <!-- Service Barang -->
                <div class="col-xxl-5 col-lg-6" data-aos-delay="200">
                    <div class="pricing-card popular">
                        <div class="card-content">
                            <h3 class="card-title mb-3 d-flex justify-content-center align-items-center" style="font-weight: 600;">
                                <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                    style="width: 45px; height: 45px; background-color: white ;">
                                    <i class="bi bi-wrench text-primary"></i>
                                </span> Servis Barang
                            </h3>
                            <p class="description text-center">Servis berbagai perangkat seperti laptop, HP, Ipad, dll.</p>

                            <h4 style="font-weight: 600;">Jenis Kerusakan :</h4>
                            <ul class="features-list">
                                @foreach ($jenisKerusakan as $kerusakan)
                                <li>
                                    <span><i class="bi bi-check-circle-fill"></i> {{ $kerusakan->nama }}</span>
                                    <strong class="ps-4 ms-1 ps-md-0 ms-md-0 ps-lg-1 ms-lg-0">
                                        Rp {{ number_format($kerusakan->harga, 0, ',', '.') }}
                                    </strong>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="#" class="btn btn-light btn-block" data-bs-toggle="modal" data-bs-target="#barangModal">Selengkapnya
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Service Jasa -->
                <div class="col-xxl-5 col-lg-6" data-aos-delay="300">
                    <div class="pricing-card">
                        <div class="card-content">
                            <h3 class="card-title mb-3 d-flex justify-content-center align-items-center" style="font-weight: 600;">
                                <span class="me-3 d-flex align-items-center justify-content-center rounded-circle bg-primary"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-tools text-white"></i>
                                </span> Servis Jasa
                            </h3>
                            <p class="description text-secondary text-center">Layanan pemasangan jaringan, instalasi software, dan konfigurasi perangkat.</p>

                            <h4 style="font-weight: 600;">Jenis Layanan :</h4>
                            <ul class="features-list">
                                @foreach ($jenisLayanan as $layanan)
                                <li>
                                    <span><i class="bi bi-check-circle-fill text-primary"></i>{{ $layanan->nama }}</span>
                                    <strong class="ps-4 ms-1 ps-md-0 ms-md-0 ps-lg-1 ms-lg-0">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</strong>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="#" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#jasaModal">Selengkapnya
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <!-- /Pricing Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 col-12 mb-lg-4 mb-md-4 mb-3 mt-3" data-aos-delay="200">
                    <div class="headline-course text-lg-start text-md-start text-center">
                        <h1 class="fs-3 fw-bold">Portofolio Proyek Kami</h1>
                        <p class="pt-1">Hasil terbaik dari layanan servis barang dan jasa yang telah kami kerjakan</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12 mb-lg-4 mb-md-4 mb-5 mt-3" data-aos-delay="200">
                    <div class="d-flex align-items-center justify-content-lg-end justify-content-md-end justify-content-center">
                        <a href="{{ route('portofolio.index') }}" class="btn btn-primary rounded-pill d-flex align-items-center gap-2 py-3 px-4" style="font-weight: 500;">
                            Lihat Lebih Banyak <i class="bi bi-arrow-right-circle fs-5"></i>
                        </a>
                    </div>
                </div>

                @foreach ($portfolios as $portfolio)
                <div class="col-lg-4 col-md-6 col-12 mb-4" data-aos-delay="50">
                    <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                        <img src="{{ asset('storage/' . $portfolio->gambar) }}" class="img-fluid" alt="{{ $portfolio->nama }}">
                        <div class="card-body" style="height: auto;">
                            <h1 class="card-title fs-5 fw-bold">{{ $portfolio->nama }}</h1>
                            <p class="text-muted">{{ Str::limit($portfolio->deskripsi, 100) }}</p>
                            <div class="read-more d-flex justify-content-end">
                                <div class="d-flex detail-pc align-items-center">
                                    <a href="{{ route('portofolio.detail', $portfolio->slug) }}" class="btn btn-primary d-flex align-items-center gap-2">
                                        Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->

    <!-- Testimoni start -->
    <section id="testimonials" class="testimonials section light-background">
        <div class="container my-3">
            <div class="col-12 mb-4 text-center">
                <h1 class="fs-3 mt-0 heading">Ulasan Pelanggan</h1>
                <p class="mb-5 pt-1 sub-heading text-secondary">Pengalaman pengguna dalam menggunakan Platform Kami</p>
            </div>
            <div id="testimonialCarousel" class="carousel slide te" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6" data-aos-delay="50">
                                <div class="testimonial-item">
                                    <img src="{{asset ('assets/user/img/digireads-assets/adel.jpeg') }}" class="testimonial-img" alt>
                                    <h3>Reva Videla Adel</h3>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div><br>
                                    <div class="testimonial-date mt-3 text-secondary d-flex">
                                        <i class="bi bi-calendar-event"></i>
                                        <div class="ms-2">
                                            <span>25 Januari 2025</span>
                                        </div>
                                    </div>
                                    <p class="mt-2" style="font-weight: 500;">
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        "Monitor ini sangat nyaman digunakan untuk bekerja dalam waktu lama. Kualitas gambar yang tajam dan warna yang akurat benar-benar memuaskan!"
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6" data-aos-delay="200">
                                <div class="testimonial-item">
                                    <img src="{{asset ('assets/user/img/digireads-assets/freya.jpeg') }}" class="testimonial-img" alt>
                                    <h3>Freya Jayawardhana</h3>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div><br>
                                    <div class="testimonial-date mt-3 text-secondary d-flex">
                                        <i class="bi bi-calendar-event"></i>
                                        <div class="ms-2">
                                            <span>25 Januari 2025</span>
                                        </div>
                                    </div>
                                    <p class="mt-2" style="font-weight: 500">
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        "Monitor LG ini benar-benar memenuhi ekspektasi saya. Kualitas gambar sempurna, nyaman digunakan bahkan untuk pekerjaan berjam-jam."
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6" data-aos-delay="350">
                                <div class="testimonial-item">
                                    <img src="{{asset ('assets/img/digireads-assets/jennie.jpeg') }}" class="testimonial-img" alt>
                                    <h3>Jennie Ruby</h3>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div><br>
                                    <div class="testimonial-date mt-3 text-secondary d-flex">
                                        <i class="bi bi-calendar-event"></i>
                                        <div class="ms-2">
                                            <span>25 Januari 2025</span>
                                        </div>
                                    </div>
                                    <p class="mt-2" style="font-weight: 500">
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        "Resolusi Full HD-nya memberikan detail yang luar biasa. Monitor ini sangat cocok untuk streaming film atau presentasi kerja."
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6" data-aos-delay="50">
                                <div class="testimonial-item">
                                    <img src="{{asset ('assets/user/img/digireads-assets/jaemin.jpeg') }}" class="testimonial-img" alt>
                                    <h3>Na Jaemin</h3>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div><br>
                                    <div class="testimonial-date mt-3 text-secondary d-flex">
                                        <i class="bi bi-calendar-event"></i>
                                        <div class="ms-2">
                                            <span>25 Januari 2025</span>
                                        </div>
                                    </div>
                                    <p class="mt-2" style="font-weight: 500">
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        "Monitor ini sangat nyaman untuk digunakan gaming. Respons yang cepat dan warna yang cerah membuat pengalaman bermain jadi lebih hidup."
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6" data-aos-delay="200">
                                <div class="testimonial-item">
                                    <img src="{{asset ('assets/user/img/digireads-assets/shani.jpeg') }}" class="testimonial-img" alt>
                                    <h3>Shani Indira</h3>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div><br>
                                    <div class="testimonial-date mt-3 text-secondary d-flex">
                                        <i class="bi bi-calendar-event"></i>
                                        <div class="ms-2">
                                            <span>25 Januari 2025</span>
                                        </div>
                                    </div>
                                    <p class="mt-2" style="font-weight: 500">
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        "Dengan sistem ini, saya dapat mengelola proyek perbaikan perangkat dan jaringan dengan lebih terstruktur, dan semua pendapatan tercatat dengan jelas."
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6" data-aos-delay="350">
                                <div class="testimonial-item">
                                    <img src="{{asset ('assets/user/img/digireads-assets/zee.jpeg') }}" class="testimonial-img rounded-circle" alt>
                                    <h3>Azizi Ashadel</h3>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div><br>
                                    <div class="testimonial-date mt-3 text-secondary d-flex">
                                        <i class="bi bi-calendar-event"></i>
                                        <div class="ms-2">
                                            <span>25 Januari 2025</span>
                                        </div>
                                    </div>
                                    <p class="mt-2" style="font-weight: 500">
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        "Saya sangat suka dengan desainnya yang ramping dan elegan. Selain itu, fitur IPS sangat membantu mengurangi pantulan dan menjaga kualitas gambar."
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
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
    <!-- Testimoni End -->

    <!-- Modal Servis Barang -->
    <div class="modal fade" id="modalServisBarang" tabindex="-1" aria-labelledby="modalServisBarangLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <div class="icon-container text-white d-flex align-items-center justify-content-center py-2 rounded-circle me-2" style="background-color: #e3f7ff; padding: 0px 15px;">
                            <i class="bi bi-wrench fs-5 text-primary"></i>
                        </div>
                        <h5 class="modal-title" style="font-weight: 600;" id="modalServisBarangLabel">Form Servis Barang</h5>
                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formServisBarang" action="{{ route('serviceBarang.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label" style="font-weight: 600;">Nama Lengkap :</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ Auth::check() ? Auth::user()->nama : '' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label" style="font-weight: 600;">No. Telepon :</label>
                            <input type="tel" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="barang" class="form-label" style="font-weight: 600;">Jenis Barang :</label>
                            <select class="form-control" id="barang" name="barang_id" required>
                                <option value="" disabled selected>Pilih Barang</option>
                                @foreach($jenisBarang as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="merk" class="form-label" style="font-weight: 600;">Merk :</label>
                            <input type="text" class="form-control" id="merk" name="merk" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kerusakan" class="form-label" style="font-weight: 600;">Pilih Jenis Kerusakan :</label>
                            <select class="form-control" id="jenis_kerusakan" name="jenis_kerusakan_id" required>
                                <option value="" disabled selected>Pilih Jenis Kerusakan</option>
                            </select>
                        </div>

                        <!-- Simpan semua jenis kerusakan dalam JSON untuk JavaScript -->
                        <script>
                            let jenisKerusakan = @json($jenisKerusakan ?? []);
                        </script>

                        <div class="mb-3">
                            <label for="kerusakan" class="form-label" style="font-weight: 600;">Kerusakan Tambahan :</label>
                            <textarea class="form-control" id="kerusakan" name="kerusakan" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label" style="font-weight: 600;">Harga Servis :</label>
                            <input type="text" class="form-control" id="harga" name="harga" readonly>
                        </div>

                        <!-- Tambahan untuk Backup -->
                        <div class="mb-3">
                            <label for="backUp" class="form-label" style="font-weight: 600;">Backup Data?</label>
                            <select class="form-control" id="backUp" name="backUp">
                                <option value="" disabled selected>Pilih Opsi</option>
                                <option value="iya">Iya</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>

                        <!-- Tambahan untuk Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label" style="font-weight: 600;">Password :</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>

                        <input type="hidden" id="status" name="status" value="pending">
                        <input type="hidden" id="proses" name="proses" value="Menunggu">

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-primary" id="btnKirim">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Servis Jasa -->
    <div class="modal fade" id="modalServisJasa" tabindex="-1" aria-labelledby="modalServisJasaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex align-items-center">
                        <div class="icon-container text-white d-flex align-items-center justify-content-center py-2 rounded-circle me-2" style="background-color: #e3f7ff; padding: 0px 15px;">
                            <i class="bi bi-tools fs-5 text-primary"></i>
                        </div>
                        <h5 class="modal-title" style="font-weight: 600;" id="modalServisJasaLabel">Form Servis Jasa</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formServisJasa" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label" style="font-weight: 600;">Nama Lengkap :</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ Auth::check() ? Auth::user()->nama : '' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label" style="font-weight: 600;">Alamat :</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label" style="font-weight: 600;">No. Telepon :</label>
                            <input type="tel" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenisJasa" class="form-label" style="font-weight: 600;">Jenis Jasa :</label>
                            <select class="form-control" id="jenisJasa" name="jenisJasa" required>
                                <option value="" disabled selected>Pilih Jasa</option>
                                @foreach($jenisLayanan as $layanan)
                                <option value="{{ $layanan->id }}">
                                    {{ $layanan->nama }} - Rp. {{ number_format($layanan->harga, 0, ',', '.') }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label" style="font-weight: 600;">Deskripsi Permintaan :</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label" style="font-weight: 600;">Tanggal Pelaksanaan :</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- modal jenis servis barang -->
    <div class="modal fade" id="barangModal" tabindex="-1" aria-labelledby="barangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="servisModalLabel">Detail Jenis Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 style="font-weight: 500;">Jenis Kerusakan :</h5>
                    <ul class="features-list ">
                        @foreach ($jenisKerusakan as $kerusakan)
                        <li>
                            <i class="bi bi-check-circle-fill text-primary"></i>
                            <div class="ker">
                                <span class="kerusakan">{{ $kerusakan->nama }}</span>
                                <span class="harga">Rp {{ number_format($kerusakan->harga, 0, ',', '.') }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal jenis servis jasa -->
    <div class="modal fade" id="jasaModal" tabindex="-1" aria-labelledby="jasaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="servisModalLabel">Detail Jenis Servis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 style="font-weight: 500;">Jenis Kerusakan :</h5>
                    <ul class="features-list ">
                        @foreach ($jenisLayanan as $layanan)
                        <li>
                            <i class="bi bi-check-circle-fill text-primary"></i>
                            <div class="ker">
                                <span class="kerusakan">{{ $layanan->nama }}</span>
                                <span class="harga">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

</main>

<script>
    document.querySelectorAll('.dropdown-toggle').forEach(function(dropdown) {
        new bootstrap.Dropdown(dropdown, {
            popperConfig: function() {
                return {
                    modifiers: [{
                        name: 'preventOverflow',
                        options: {
                            boundary: 'window'
                        }, // Ubah boundary ke 'window'
                    }, ],
                };
            },
        });
    });
</script>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let barangSelect = document.getElementById("barang");
        let kerusakanSelect = document.getElementById("jenis_kerusakan");
        let hargaInput = document.getElementById("harga");
        let btnKirim = document.getElementById("btnKirim");
        let form = document.getElementById("formServisBarang");

        // Saat memilih jenis barang, filter jenis kerusakan
        barangSelect.addEventListener("change", function() {
            let barangID = this.value;
            kerusakanSelect.innerHTML = '<option value="" disabled selected>Pilih Jenis Kerusakan</option>';
            hargaInput.value = "";

            let filteredKerusakan = jenisKerusakan.filter(k => k.barang_id == barangID);

            if (filteredKerusakan.length > 0) {
                filteredKerusakan.forEach(item => {
                    let option = document.createElement("option");
                    option.value = item.id;
                    option.setAttribute("data-harga", item.harga);
                    option.textContent = item.nama;
                    kerusakanSelect.appendChild(option);
                });
            } else {
                let option = document.createElement("option");
                option.value = "";
                option.textContent = "Tidak ada jenis kerusakan";
                kerusakanSelect.appendChild(option);
            }
        });

        // Saat memilih jenis kerusakan, isi harga otomatis
        kerusakanSelect.addEventListener("change", function() {
            let selectedOption = this.options[this.selectedIndex];
            let harga = selectedOption.getAttribute("data-harga") || 0;
            hargaInput.value = formatRupiah(harga);
        });

        // Fungsi format angka ke Rupiah
        function formatRupiah(angka) {
            return "Rp. " + parseInt(angka).toLocaleString("id-ID");
        }

        // Integrasi Midtrans saat tombol Kirim ditekan
        btnKirim.addEventListener("click", function() {
            let hargaValue = hargaInput.value.replace(/\D/g, '');
            if (!hargaValue || hargaValue == "0") {
                alert("Silakan pilih jenis barang dan kerusakan terlebih dahulu.");
                return;
            }

            let formData = new FormData(form); // Ambil semua data dari form

            fetch("{{ route('serviceBarang.store') }}", {
                    method: "POST",
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.token) { // Fix: Gunakan 'token' bukan 'snap_token'
                        // Tampilkan Midtrans Snap
                        window.snap.pay(data.token, {
                            onSuccess: function(result) {
                                alert("Pembayaran berhasil!");
                                window.location.href = "{{ route('serviceBarang.invoice', '') }}/" + result.order_id;
                            },
                            onPending: function(result) {
                                alert("Pembayaran pending.");
                            },
                            onError: function(result) {
                                alert("Pembayaran gagal.");
                            }
                        });
                    } else {
                        alert("Gagal mendapatkan token pembayaran.");
                    }
                })
                .catch(error => console.error("Error:", error));
        });
    });
</script>

<script>
    document.getElementById('formServisJasa').addEventListener('submit', function(event) {
        event.preventDefault(); // Hindari submit form secara langsung

        let formData = new FormData(this);

        fetch("{{ route('serviceLayanan.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Response dari Server:", data); // Debugging

                if (data.token) {
                    console.log("Snap Token:", data.token); // Debugging

                    window.snap.pay(data.token, {
                        onSuccess: function(result) {
                            alert("Pembayaran berhasil!");
                            window.location.href = "{{ route('serviceLayanan.invoice', '') }}/" + result.order_id;
                        },
                        onPending: function(result) {
                            alert("Pembayaran pending.");
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal.");
                        }
                    });
                } else {
                    console.error("Gagal mendapatkan token pembayaran. Response:", data);
                    alert("Gagal mendapatkan token pembayaran.");
                }
            })
            .catch(error => {
                console.error("Fetch Error:", error);
                alert("Terjadi kesalahan dalam pengiriman data.");
            });
    });
</script>


@endsection