@extends('home.layouts.app')

@section('content')

<style>
    .hidden {
        display: none;
    }

    .card img.img-fluid {
        height: 200px;
        object-fit: cover;
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
                            <li class="breadcrumb-item"><a href="#" class=" text-primary">Portofolio</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumbs end -->


    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section" style="margin-top: -60px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-12 mb-lg-4 mb-md-4 mb-3">
                    <div class="headline-course text-lg-start text-md-start text-center">
                        <h1 class="fs-3 fw-bold">Portofolio Proyek Kami</h1>
                        <p class="pt-1">Hasil terbaik dari layanan servis barang dan jasa yang telah kami kerjakan</p>
                    </div>
                </div>

                <!-- Daftar Kartu Proyek -->
                <div id="cardContainer" class="row">

                    @foreach ($portofolios as $index => $portofolio)
                    <div class="col-lg-4 col-md-6 col-12 mb-4 portfolio-item {{ $index >= 6 ? 'd-none' : '' }}">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{ asset('storage/' . $portofolio->gambar) }}" class=" img-fluid" alt="{{ $portofolio->nama }}">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">{{ $portofolio->nama }}</h5>
                                <p class="text-muted">{{ Str::limit($portofolio->deskripsi, 100) }}</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{ route('portofolio.detail', $portofolio->slug) }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>

                <!-- Tombol "Lihat Lebih Banyak" -->
                @if ($portofolios->count() > 3)
                <div class="col-12 mb-lg-4 mb-md-4 mb-5 mt-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <button id="showMoreBtn" class="btn btn-primary rounded-pill d-flex align-items-center gap-2 py-3 px-4" style="font-weight: 500;">
                            Lihat Lebih Banyak <i class="bi bi-arrow-right-circle fs-5"></i>
                        </button>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </section>
    <!-- Portfolio Section -->


</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let showMoreBtn = document.getElementById("showMoreBtn");
        let clickCount = 0; // Counter untuk jumlah klik tombol

        if (showMoreBtn) {
            showMoreBtn.addEventListener("click", function() {
                let hiddenItems = document.querySelectorAll(".portfolio-item.d-none");
                let count = 0;

                hiddenItems.forEach((item) => {
                    if (count < 3) {
                        item.classList.remove("d-none");
                        count++;
                    }
                });

                clickCount++; // Tambahkan hitungan klik

                setTimeout(function() {
                    let remainingHiddenItems = document.querySelectorAll(".portfolio-item.d-none");

                    if (remainingHiddenItems.length === 0 && clickCount > 1) {
                        // **SweetAlert muncul hanya setelah tombol diklik dua kali saat semua data terlihat**
                        Swal.fire({
                            title: 'Semua Portofolio Terlihat',
                            text: 'Tidak ada lagi portofolio yang tersembunyi.',
                            icon: 'success',
                            confirmButtonText: 'Oke',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }
                        });

                        // **Hapus event listener agar tombol tidak bisa diklik lagi**
                        showMoreBtn.removeEventListener("click", arguments.callee);
                    }
                }, 100);
            });
        }
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