@extends('home.layouts.app')

@section('content')

<main class="main">
    <!-- Breadcrumbs start -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container mt-5 pt-5">
            <div class="row align-items-center">
                <div class="col-lg-12 mt-4">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route ('index') }}" class="text-secondary">
                                    <i class="bi bi-house-door icon" style="font-size: 19px;"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route ('riwayat') }}" class=" text-primary">Riwayat</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumbs end -->

    <!-- Riwayat start -->
    <section class="riwayat" style="margin-top:-60px;">
        <div class="container">
            <div class="row d-flex justify-content-between mb-4 pb-3">
                <div class="col-xxl-6 col-lg-7 col-md-10 col-12 mb-lg-0 mb-md-4 mb-3">
                    <ul class="nav nav-pills flex-nowrap overflow-auto d-flex w-100" style="white-space: nowrap;">
                        <li class="nav-item me-1 mb-lg-0 mb-md-0 mb-3">
                            <a class="nav-link tab-link link-custom active" id="all-tab" data-bs-toggle="pill" href="#all">All</a>
                        </li>
                        <li class="nav-item me-1 mb-lg-0 mb-md-0 mb-3">
                            <a class="nav-link tab-link link-custom" id="Servis-jasa-tab" data-bs-toggle="pill" href="#Servis-jasa">Servis Jasa</a>
                        </li>
                        <li class="nav-item me-1 mb-lg-0 mb-md-0 mb-3">
                            <a class="nav-link tab-link link-custom" id="Servis-barang-tab" data-bs-toggle="pill" href="#Servis-barang">Servis Barang</a>
                        </li>
                        <li class="nav-item me-1 mb-lg-0 mb-md-0 mb-3">
                            <a class="nav-link tab-link link-custom" id="pembelian-tab" data-bs-toggle="pill" href="#pembelian">Pembelian</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-10 col-12 mt-3 mt-md-0 text-end mb-3">
                    <input type="text" class="form-control" placeholder="Cari Produk..." id="search-input">
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="all">
                    <div class="row">
                        <!-- Servis Jasa Card -->
                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title mb-3 d-flex align-items-center">
                                        <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                            style="width: 45px; height: 45px; background-color: #007bff;">
                                            <i class="bi bi-tools text-white"></i>
                                        </span>
                                        Servis Jasa
                                    </h5>
                                    <!-- Informasi Riwayat -->
                                    <ul class="list-unstyled">
                                        <li class="mb-1"><span style="font-weight: 600;">No. Order :</span> 12345</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Petugas :</span> John Doe</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Layanan :</span> Perbaikan Elektronik</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Nama Servis :</span> Reparasi TV</li>
                                        <li>
                                            <span style="font-weight: 500;">Status :</span>
                                            <span class="badge p-2" style="background-color: #fff3cd; color: #c99700;">On Progress</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Servis Barang Card -->
                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title mb-3 d-flex align-items-center">
                                        <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                            style="width: 45px; height: 45px; background-color: #20b1ff;">
                                            <i class="bi bi-wrench text-white"></i>
                                        </span> Servis Barang
                                    </h5>
                                    <!-- Informasi Riwayat -->
                                    <ul class="list-unstyled">
                                        <li class="mb-1"><span style="font-weight: 600;">No. Order :</span> 12345</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Petugas :</span> John Doe</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Barang :</span> Laptop</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Kerusakan :</span> Layar Pecah</li>
                                        <li>
                                            <span style="font-weight: 600;">Status :</span>
                                            <span class="badge p-2" style="background-color: #fff3cd; color: #c99700;">On Progress</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Produk Pembelian Card -->
                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-lg-center flex-md-column flex-lg-row">
                                        <!-- Gambar Produk -->
                                        <div class="mb-3 mb-md-4 me-md-4 text-center">
                                            <img src="{{asset ('assets/user/img/digireads-assets/LG 29 ULTRAWIDE FHD HDR MONITOR 29WP60G-B.png') }}" alt="Produk" class="img-fluid rounded"
                                                style="width: 110px; height: 90px; object-fit: cover;">
                                        </div>

                                        <!-- Informasi Produk -->
                                        <div class="desc-pembelian">
                                            <p class="mb-3" style="font-weight: 700;">LG 29 ULTRAWIDE FHD HDR MONITOR 29WP60G-B</p>
                                            <p class="mb-1"><span style="font-weight: 600;">Jumlah :</span> 2</p>
                                            <p class="mb-1"><span style="font-weight: 600;">Harga Satuan</span> : Rp 2.500.000</p>
                                            <p class="mb-0"><span style="font-weight: 600;">Total :</span> <span style="color: #007bff;">Rp 5.000.000</span></p>
                                        </div>
                                    </div>

                                    <!-- Tombol Beli Lagi -->
                                    <div class="text-end mt-4">
                                        <button class="btn btn-primary">
                                            <i class="bi bi-cart-plus me-2"></i>Beli Lagi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Servis Jasa Tab -->
                <div class="tab-pane fade" id="Servis-jasa">
                    <div class="row mt-0">
                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title mb-3 d-flex align-items-center">
                                        <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                            style="width: 45px; height: 45px; background-color: #007bff;">
                                            <i class="bi bi-tools text-white"></i>
                                        </span>
                                        Servis Jasa
                                    </h5>
                                    <!-- Informasi Riwayat -->
                                    <ul class="list-unstyled">
                                        <li class="mb-1"><span style="font-weight: 600;">No. Order :</span> 12345</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Petugas :</span> Hanan Wian</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Layanan :</span> Instalasi Jaringan</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Nama Servis :</span> Instalasi Jaringan</li>
                                        <li>
                                            <span style="font-weight: 500;">Status :</span>
                                            <span class="badge p-2" style="background-color: #fff3cd; color: #c99700;">On Progress</span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title mb-3 d-flex align-items-center">
                                        <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                            style="width: 45px; height: 45px; background-color: #007bff;">
                                            <i class="bi bi-tools text-white"></i>
                                        </span> Servis Jasa
                                    </h5>
                                    <!-- Informasi Riwayat -->
                                    <ul class="list-unstyled">
                                        <li class="mb-1"><span style="font-weight: 600;">No. Order :</span> 12345</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Petugas :</span> Kirana Yasya</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Layanan :</span> Instalasi Jaringan</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Nama Servis :</span> Instalasi Jaringan</li>
                                        <li><span style="font-weight: 600;">Status :</span> <span class="badge p-2" style="background-color: #ffdada; color: #e60000;">Pending</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title mb-3 d-flex align-items-center">
                                        <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                            style="width: 45px; height: 45px; background-color: #007bff;">
                                            <i class="bi bi-tools text-white"></i>
                                        </span> Servis Jasa
                                    </h5>
                                    <!-- Informasi Riwayat -->
                                    <ul class="list-unstyled">
                                        <li class="mb-1"><span style="font-weight: 600;">No. Order :</span> 12345</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Petugas :</span> Meisya Putri</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Layanan :</span> Instalasi Jaringan</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Nama Servis :</span> Instalasi Jaringan</li>
                                        <li><span style="font-weight: 600;">Status :</span> <span class="badge p-2" style="background-color: #c3ffc3;color: #00ab00;">Selesai</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title mb-3 d-flex align-items-center">
                                        <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                            style="width: 45px; height: 45px; background-color: #007bff;">
                                            <i class="bi bi-tools text-white"></i>
                                        </span>Servis Jasa
                                    </h5>
                                    <!-- Informasi Riwayat -->
                                    <ul class="list-unstyled">
                                        <li class="mb-1"><span style="font-weight: 600;">No. Order :</span> 12345</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Petugas :</span> Garcia Valencia</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Layanan :</span> Instalasi Jaringan</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Nama Servis :</span> Instalasi Jaringan</li>
                                        <li><span style="font-weight: 600;">Status :</span>
                                            <span class="badge p-2" style="background-color: #cce5ff; color: #157ff1;">Menuju ke Lokasi</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Servis Barang Tab -->
                <div class="tab-pane fade" id="Servis-barang">
                    <div class="row mt-0">
                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title mb-3 d-flex align-items-center">
                                        <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                            style="width: 45px; height: 45px; background-color: #20b1ff;">
                                            <i class="bi bi-wrench text-white"></i>
                                        </span>Servis Barang
                                    </h5>
                                    <!-- Informasi Riwayat -->
                                    <ul class="list-unstyled">
                                        <li class="mb-1"><span style="font-weight: 600;">No. Order :</span> 12345</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Petugas :</span> John Doe</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Barang :</span> Laptop</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Kerusakan :</span> Layar Pecah</li>
                                        <li>
                                            <span style="font-weight: 600;">Status :</span>
                                            <span class="badge p-2" style="background-color: #fff3cd; color: #c99700;">On Progress</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title mb-3 d-flex align-items-center">
                                        <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                            style="width: 45px; height: 45px; background-color: #20b1ff;">
                                            <i class="bi bi-wrench text-white"></i>
                                        </span>Servis Barang
                                    </h5>
                                    <!-- Informasi Riwayat -->
                                    <ul class="list-unstyled">
                                        <li class="mb-1"><span style="font-weight: 600;">No. Order :</span> 67890</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Petugas :</span> Jane Smith</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Barang :</span> Mesin Cuci</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Kerusakan :</span> Tidak Bisa Menyala</li>
                                        <li>
                                            <span style="font-weight: 600;">Status :</span>
                                            <span class="badge p-2" style="background-color: #ffdada; color: #e60000;">Pending</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <!-- Title -->
                                    <h5 class="card-title mb-3 d-flex align-items-center">
                                        <span class="me-3 d-flex align-items-center justify-content-center rounded-circle"
                                            style="width: 45px; height: 45px;background-color: #14adff;">
                                            <i class="bi bi-wrench text-white"></i>
                                        </span>Servis Barang
                                    </h5>
                                    <!-- Informasi Riwayat -->
                                    <ul class="list-unstyled">
                                        <li class="mb-1"><span style="font-weight: 600;">No. Order :</span> 54321</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Petugas :</span> Michael Brown</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Barang :</span> Kulkas</li>
                                        <li class="mb-1"><span style="font-weight: 600;">Kerusakan :</span> Tidak Dingin</li>
                                        <li>
                                            <span style="font-weight: 600;">Status :</span>
                                            <span class="badge p-2" style="background-color: #c3ffc3;color: #00ab00;">Selesai</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pembelian Tab -->
                <div class="tab-pane fade show active" id="pembelian">
                    <div class="row mt-0">
                        @foreach ($orders as $order)
                        @foreach ($order->items as $item)
                        <div class="col-12 col-md-6 col-lg-4 mb-4 product">
                            <div class="card shadow-md p-2">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-lg-center flex-md-column flex-lg-row">
                                        <!-- Gambar Produk -->
                                        <div class="mb-3 mb-md-4 me-md-4 text-center">
                                            <img src="{{ asset('storage/'.$item->produk->gambar) }}"
                                                alt="Produk" class="img-fluid rounded"
                                                style="width: 110px; height: 90px; object-fit: cover;">
                                        </div>

                                        <!-- Informasi Produk -->
                                        <div class="desc-pembelian">
                                            <p class="mb-3" style="font-weight: 700;">{{ $item->produk->nama }}</p>
                                            <p class="mb-1"><span style="font-weight: 600;">Jumlah :</span> {{ $item->jumlah }}</p>
                                            <p class="mb-1"><span style="font-weight: 600;">Harga Satuan</span> : Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                            <p class="mb-0"><span style="font-weight: 600;">Total :</span> <span style="color: #007bff;">Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</span></p>
                                        </div>
                                    </div>

                                    <!-- Tombol Beli Lagi -->
                                    <div class="text-end mt-4">
                                        <button class="btn btn-primary">
                                            <i class="bi bi-cart-plus me-2"></i>Beli Lagi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endforeach
                    </div>
                </div>

            </div>
    </section>
    <!-- Riwayat end -->

</main>

<!-- js search -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("search-input");
        const products = document.querySelectorAll(".product");

        searchInput.addEventListener("keyup", function() {
            const query = searchInput.value.toLowerCase();

            products.forEach(product => {
                const productText = product.textContent.toLowerCase();
                if (productText.includes(query)) {
                    product.style.display = "block"; // Tampilkan jika cocok
                } else {
                    product.style.display = "none"; // Sembunyikan jika tidak cocok
                }
            });
        });
    });
</script>

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

@endsection