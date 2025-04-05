@extends('home.layouts.app')

@section('content')

<style>
    .modal-dialog-slide-in {
        position: fixed;
        right: 0;
        margin: 0;
        height: 100vh;
        max-height: 100vh;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
    }

    .modal-content {
        height: 100%;
        display: flex;
        flex-direction: column;
        width: 500px;
    }

    .modal-content .modal-body img {
        width: 140px;
        height: 120px;
    }

    .tab .row button.keranjang {
        margin-top: -20px;
    }

    .custom-bg-color {
        background-color: #e3f7ff;
    }

    .modal-content .modal-body .quantity-input {
        width: 45px;
        font-size: 14px;
    }


    @media (max-width: 767px) {
        .tab .row button.keranjang {
            margin-top: 0;
        }

        .tab .row .col-12 {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .modal-dialog-slide-in {
            width: 100%;
        }

        .modal-content {
            width: 100%;
            height: 100vh;
        }

    }

    @media (max-width:425px) {
        .modal-content .modal-body img {
            width: 110px;
            height: 100px;
        }

        .modal-content .modal-body .flex-grow-1 h5 {
            font-size: 18px;
        }

        .modal-content .modal-body .flex-grow-1 p {
            font-size: 13px;
        }

        .modal-content .modal-body button.btn-delete {
            font-size: 13px;
        }
    }

    @media (max-width: 399px) {
        .modal-header h5 {
            font-size: 17px;
        }

        .modal-content .modal-body img {
            width: 90px;
            height: 80px;
        }

        .modal-content .modal-body .flex-grow-1 h5 {
            font-size: 17px;
        }

        .modal-content .modal-body .flex-grow-1 p {
            font-size: 13px;
        }

        .modal-content .modal-body button.btn-delete {
            font-size: 12px;
        }

        .modal-content .modal-body .quantity-input {
            width: 35px;
            font-size: 10px;
        }

        .modal-content .modal-body .btn-outline-secondary {
            font-size: 12px;
            padding: 3px 8px;
        }
    }

    @media (max-width: 320px) {
        .modal-header h5 {
            font-size: 15px;
        }

        .modal-content .modal-body img {
            width: 80px;
            height: 70px;
        }

        .modal-content .modal-body .flex-grow-1 h5 {
            font-size: 14px;
        }

        .modal-content .modal-body .flex-grow-1 p {
            font-size: 11px;
        }

        .modal-content .modal-body button.btn-delete {
            font-size: 10px;
            padding: 4px 8px;
        }

        .modal-content .modal-body .quantity-input {
            width: 30px;
            font-size: 10px;
        }

        .modal-content .modal-body .btn-outline-secondary {
            font-size: 10px;
        }
    }
</style>
<main class="main">
    <!-- breadcrumbs start -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container mt-5 pt-5">
            <div class="row align-items-center">
                <div class="col-lg-12 mt-4">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{route ('index') }}">
                                    <i class="bi bi-house-door icon text-secondary" style="font-size: 19px;"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('pembelian', ['kategori' => 'default_kategori']) }}">Pembelian</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumbs end -->

    <!-- tab start -->
    <section id="tab-produk" class="tab produk section pt-0">
        <div class="container">
            <div class="row gy-4 mb-4 d-flex justify-content-between align-items-center">
                <div class="col-lg-5 col-md-7 col-12 text-lg-start text-md-start text-center" data-aos-delay="30">
                    <h2 class="about-title">
                        Temukan <span style="color:#007BFF;">Produk</span> yang Anda Butuhkan Saat Ini
                    </h2>
                </div>
                @auth
                <div class="col-lg-5 col-md-5 col-12 d-flex justify-content-lg-end justify-content-md-end justify-content-center align-items-center mb-4" data-aos-delay="50">
                    <button type="button" class="btn btn-primary rounded keranjang pb-2 pt-2 py-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
                        <i class="bi bi-cart fs-5 me-2"></i> Keranjang Anda
                    </button>
                </div>
                @endauth
            </div>

            <!-- Tab Produk Start -->
            <div class="row">
                <div class="container mt-lg-2">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xxl-6 col-lg-7 col-md-10 col-12 mb-lg-3 mb-md-3 mb-1">
                            <ul class="nav nav-pills flex-nowrap overflow-auto" style="margin-bottom: 15px; padding-bottom: 15px;">
                                <!-- Tab "All" -->
                                <li class="nav-item me-3">
                                    <a class="nav-link tab-link link-custom active" id="all-tab" data-bs-toggle="pill" href="#all">All</a>
                                </li>

                                <!-- Loop kategori -->
                                @foreach ($kategoriProdukList as $kategori)
                                <li class="nav-item me-3">
                                    <a class="nav-link tab-link link-custom" id="{{ strtolower($kategori->nama) }}-tab" data-bs-toggle="pill" href="#kategori-{{ $kategori->id }}">
                                        {{ $kategori->nama }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>

                        </div>
                        <div class="col-lg-4 col-md-10 col-12 mt-3 mt-md-0 text-end mb-3">
                            <input type="text" class="form-control" placeholder="Cari Produk..." id="search-input">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="tab-content mt-3">

                    <!-- All Tab -->
                    <div class="tab-pane fade show active" id="all">
                        <div id="productCarousel1" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @php $chunkedProducts = $produkShow->chunk(4); @endphp

                                @foreach ($chunkedProducts as $index => $products)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach ($products as $product)
                                        <div class="col-lg-3 col-md-6 col-12 mb-lg-5 mb-md-5 mb-4 product">
                                            <div class="card">
                                                @auth
                                                <a class="btn icon-detail-link add-to-cart" data-id="{{ $product->id }}">
                                                    <div class="icon-detail">
                                                        <i class="bi bi-cart3 text-primary"></i>
                                                    </div>
                                                </a>
                                                @else
                                                <a href="{{ route('login') }}" class="icon-detail-link">
                                                    <div class="icon-detail">
                                                        <i class="bi bi-cart3 text-primary"></i>
                                                    </div>
                                                </a>
                                                @endauth
                                                <img src="{{ asset($product->gambar) }}" alt="{{ $product->nama }}" />
                                                <div class="card-body pt-0 px-0 pb-0 my-3 text-start">
                                                    <div class="col px-4">
                                                        <h5 class="card-title">{{ $product->nama }}</h5>

                                                        @php
                                                        $maxLength = 80; // Batasi hingga sekitar 80 karakter
                                                        $deskripsi = Str::limit($product->deskripsi, $maxLength, '...');
                                                        @endphp

                                                        <p class="text-secondary">{{ $deskripsi }}</p>

                                                    </div>
                                                    <div class="bottom-elements px-4">
                                                        <h6 class="mb-2 fs-5">
                                                            <span>Rp {{ number_format($product->harga, 0, ',', '.') }}</span>
                                                        </h6>

                                                        @php
                                                        // Ambil jumlah total ulasan dan rata-rata rating
                                                        $totalUlasan = \App\Models\Ulasan::where('id_produk', $product->id)->count();
                                                        $totalRating = \App\Models\Ulasan::where('id_produk', $product->id)->avg('rating') ?? 0;
                                                        $roundedRating = floor($totalRating);
                                                        $hasHalfStar = ($totalRating - $roundedRating) >= 0.5;
                                                        @endphp

                                                        <div class="Rating d-flex">
                                                            <span class="text-warning">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <=$roundedRating)
                                                                    <i class="bi bi-star-fill"></i>
                                                                    @elseif ($i == $roundedRating + 1 && $hasHalfStar)
                                                                    <i class="bi bi-star-half"></i>
                                                                    @else
                                                                    <i class="bi bi-star"></i>
                                                                    @endif
                                                                    @endfor
                                                            </span>
                                                            <p class="ms-3">({{ $totalUlasan }})</p>
                                                        </div>
                                                        @if(Auth::check())
                                                        <a href="{{ route('detail-produk', ['slug' => $product->slug]) }}" class="btn btn-primary rounded-pill" style="padding: 10px 20px;">Beli Sekarang</a>
                                                        @else
                                                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill" style="padding: 10px 20px;">Beli Sekarang</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel1" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel1" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>


                    <!-- Monitor Tab -->
                    @foreach ($kategoriProdukList as $kategori)
                    <div class="tab-pane fade" id="kategori-{{ $kategori->id }}">
                        <div id="productCarousel-{{ $kategori->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @php
                                $chunks = $kategori->produk->chunk(4); // Bagi produk dalam kelompok 4
                                @endphp

                                @foreach ($chunks as $index => $chunk)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="row">
                                        @foreach ($chunk as $produk)
                                        <div class="col-lg-3 col-md-6 col-12 mb-lg-5 mb-md-5 mb-4 product">
                                            <div class="card">
                                                @auth
                                                <a class="btn icon-detail-link add-to-cart" data-id="{{ $product->id }}">
                                                    <div class="icon-detail">
                                                        <i class="bi bi-cart3 text-primary"></i>
                                                    </div>
                                                </a>
                                                @else
                                                <a href="{{ route('login') }}" class="icon-detail-link">
                                                    <div class="icon-detail">
                                                        <i class="bi bi-cart3 text-primary"></i>
                                                    </div>
                                                </a>
                                                @endauth
                                                <img src="{{ asset($produk->gambar) }}" alt="{{ $produk->nama }}" />
                                                <div class="card-body pt-0 px-0 pb-0 my-3 text-start">
                                                    <div class="col px-4">
                                                        <h5 class="card-title">{{ $produk->nama }}</h5>
                                                        <p class="text-secondary">{{ Str::limit($produk->deskripsi, 80, '...') }}</p>
                                                    </div>

                                                    <!-- Bagian bawah untuk harga, rating, dan tombol -->
                                                    <div class="bottom-elements px-4">
                                                        <h6 class="mb-2 fs-5">
                                                            <span>Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                                        </h6>
                                                        <div class="Rating d-flex">
                                                            <span class="text-warning">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i class="bi {{ $i <= ($produk->rating ?? 0) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                                                    @endfor
                                                            </span>
                                                            <p class="ms-3">{{$produk->stok_in}}</p>
                                                        </div>
                                                        @if(Auth::check())
                                                        <a href="{{ route('detail-produk', ['slug' => $product->slug]) }}" class="btn btn-primary rounded-pill" style="padding: 10px 20px;">Beli Sekarang</a>
                                                        @else
                                                        <a href="{{ route('login') }}" class="btn btn-primary rounded-pill" style="padding: 10px 20px;">Beli Sekarang</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Kontrol carousel -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel-{{ $kategori->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel-{{ $kategori->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
        <!-- Tab Produk End -->
        </div>
    </section>
    <!-- tab end -->
</main>

<!-- modal tambah -->
<div class="modal modal-dialog-scrollable fade modal-slide-in" id="modalTambahProduk" tabindex="-1" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-slide-in">
        <div class="modal-content">
            <div class="modal-header">
                <span class="badge custom-bg-color me-2 p-2">
                    <i class="bi bi-cart fs-5 text-primary"></i>
                </span>
                <h5 class="modal-title" style="font-weight: 600;" id="modalTambahProdukLabel">Keranjang Anda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="cart-items-container">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary w-100 py-2 rounded-pill" style="font-weight: 600;" id="checkout-btn">
                    <i class="bi bi-cart-check fs-5 me-1"></i> Beli Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.add-to-cart', function(event) {
        event.preventDefault(); // Mencegah halaman berpindah tempat

        console.log("Tombol diklik!"); // Debugging
        let productId = $(this).data('id');
        console.log(productId); // Periksa apakah ID produk terbaca dengan benar

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                produk_id: productId,
                jumlah: 1
            },
            success: function(response) {
                console.log(response);
                Swal.fire({
                    icon: response.success ? 'success' : 'error',
                    title: response.success ? 'Berhasil!' : 'Gagal!',
                    text: response.message
                });
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan!'
                });
            }
        });
    });
</script>

<script>
    // Ketika modal ditampilkan, ambil data keranjang dan tampilkan produk
    $('#modalTambahProduk').on('show.bs.modal', function() {
        $.ajax({
            url: "{{ route('cart.get') }}", // Pastikan ini sesuai dengan route yang ada di routes/web.php
            type: 'GET',
            success: function(response) {
                const cartItems = response.cart;
                let htmlContent = '';

                if (cartItems.length > 0) {
                    cartItems.forEach(item => {
                        htmlContent += `
                            <a href="/detail-produk/${item.produk.slug}">
                            <div class="cart-item d-flex align-items-center border-bottom pb-3 mb-3" style="cursor: pointer;">
                                <img src="${item.produk.gambar}" alt="${item.produk.nama}" class="img-thumbnail me-3">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center">
                                        <h5 class="mb-1">${item.produk.nama}</h5>
                                    </div>
                                    <p class="text-danger fw-bold">Rp ${item.produk.harga}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-outline-secondary btn-sm me-2 minus-btn">-</button>
                                            <input type="text" value="${item.jumlah}" class="form-control text-center quantity-input" readonly>
                                            <button class="btn btn-outline-secondary btn-sm ms-2 plus-btn">+</button>
                                        </div>          
                                            <button class="btn btn-primary py-2 px-lg-4 px-md-4 px-3 btn-sm btn-delete" data-id="${item.id}" id="cart-item-${item.id}">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </a>
                    `;
                    });
                } else {
                    htmlContent = '<p>Keranjang Anda kosong</p>';
                }

                // Tampilkan produk di dalam kontainer
                $('#cart-items-container').html(htmlContent);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
            }
        });
    });
</script>

<script>
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault(); // Mencegah aksi default

        let cartItemId = $(this).data('id'); // Ambil ID produk yang akan dihapus

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Item ini akan dihapus dari keranjang!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, hapus!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/cart/remove/" + cartItemId, // Sesuaikan dengan route Anda
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}", // CSRF token Laravel
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Item berhasil dihapus dari keranjang.',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload(); // Reload halaman setelah berhasil
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat menghapus item.',
                        });
                    }
                });
            }
        });
    });
</script>

<!-- js search -->
<script>
    const searchInput = document.getElementById('search-input');

    const products = document.querySelectorAll('.product');

    function searchProducts() {
        const searchTerm = searchInput.value.toLowerCase();
        products.forEach(product => {
            const productName = product.querySelector('h5').innerText.toLowerCase();
            if (productName.includes(searchTerm)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('input', searchProducts);
</script>

<!-- js tambah jumlah produk -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".minus-btn").forEach(button => {
            button.addEventListener("click", function() {
                let input = this.nextElementSibling;
                let value = parseInt(input.value);
                if (value > 1) {
                    input.value = value - 1;
                }
            });
        });

        document.querySelectorAll(".plus-btn").forEach(button => {
            button.addEventListener("click", function() {
                let input = this.previousElementSibling;
                let value = parseInt(input.value);
                input.value = value + 1;
            });
        });
    });
</script>

@endsection