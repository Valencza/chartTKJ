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
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/electronic-technician-holds-two-identical-smartphones-comparison-one-hand-broken-another-new.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Servis Laptop & PC</h5>
                                <p class="text-muted">Kami telah menangani berbagai macam proyek perbaikan, upgrade, dan optimasi laptop serta PC untuk meningkatkan performa dan daya tahan perangkat.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/top-view-wi-fi-router-with-laptop-hand-holding-smartphone.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Instalasi Jaringan</h5>
                                <p class="text-muted">Pengalaman dalam pemasangan dan konfigurasi jaringan, baik untuk perkantoran, bisnis, maupun rumah, dengan hasil yang stabil dan aman.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/modern-data-center-providing-cloud-services-enabling-businesses-access-computing-resources-storage-demand-internet-server-room-infrastructure-3d-render-animation.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Maintenance Server</h5>
                                <p class="text-muted">Kami menangani pemeliharaan server, termasuk optimasi, pembaruan sistem, serta peningkatan keamanan untuk memastikan performa tetap optimal.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/portrait-female-working.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Perbaikan Hardware Komputer</h5>
                                <p class="text-muted">Berbagai macam masalah perangkat keras seperti motherboard, RAM, hard disk, dan komponen lainnya telah berhasil kami tangani dengan solusi terbaik.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/criminal-hacking-system-unsuccessfully.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Pengaturan Keamanan Jaringan</h5>
                                <p class="text-muted">Kami selalu Menerapkan sistem keamanan jaringan, firewall, serta enkripsi data untuk melindungi sistem dari serangan siber dan adanya kebocoran informasi.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/html-css-collage-concept-with-person.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Instalasi & Konfigurasi Software</h5>
                                <p class="text-muted">Instalasi sistem operasi,Instalasi sistem operasi, perangkat lunak profesional, serta optimasi software untuk mendukung kebutuhan kerja dan produktivitas pengguna.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Kartu yang disembunyikan -->
                    <div class="col-lg-4 col-md-6 col-12 mb-4 hidden">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/electronic-technician-holds-two-identical-smartphones-comparison-one-hand-broken-another-new.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Servis Laptop & PC</h5>
                                <p class="text-muted">Kami telah menangani berbagai macam proyek perbaikan, upgrade, dan optimasi laptop serta PC untuk meningkatkan performa dan daya tahan perangkat.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4 hidden">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/top-view-wi-fi-router-with-laptop-hand-holding-smartphone.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Instalasi Jaringan</h5>
                                <p class="text-muted">Pengalaman dalam pemasangan dan konfigurasi jaringan, baik untuk perkantoran, bisnis, maupun rumah, dengan hasil yang stabil dan aman.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4 hidden">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/modern-data-center-providing-cloud-services-enabling-businesses-access-computing-resources-storage-demand-internet-server-room-infrastructure-3d-render-animation.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Maintenance Server</h5>
                                <p class="text-muted">Kami menangani pemeliharaan server, termasuk optimasi, pembaruan sistem, serta peningkatan keamanan untuk memastikan performa tetap optimal.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4 hidden">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/portrait-female-working.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Perbaikan Hardware Komputer</h5>
                                <p class="text-muted">Berbagai macam masalah perangkat keras seperti motherboard, RAM, hard disk, dan komponen lainnya telah berhasil kami tangani dengan solusi terbaik.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4 hidden">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/criminal-hacking-system-unsuccessfully.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Pengaturan Keamanan Jaringan</h5>
                                <p class="text-muted">Kami selalu Menerapkan sistem keamanan jaringan, firewall, serta enkripsi data untuk melindungi sistem dari serangan siber dan adanya kebocoran informasi.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-4 hidden">
                        <div class="card mb-4 p-3 border-0 shadow" style="border-radius: 20px;">
                            <img src="{{asset ('assets/user/img/digireads-assets/html-css-collage-concept-with-person.jpg') }}" class=" img-fluid" alt="Servis Laptop & PC">
                            <div class="card-body" style="height: auto;">
                                <h5 class="" style="font-weight: 700;">Proyek Instalasi & Konfigurasi Software</h5>
                                <p class="text-muted">Instalasi sistem operasi,Instalasi sistem operasi, perangkat lunak profesional, serta optimasi software untuk mendukung kebutuhan kerja dan produktivitas pengguna.</p>
                                <div class="read-more d-flex justify-content-end">
                                    <div class="d-flex detail-pc align-items-center">
                                        <a href="{{route ('detail-portofolio') }}" class="btn btn-primary d-flex align-items-center gap-2">
                                            Lihat Detail <i class="bi bi-arrow-right-circle fs-5 ms-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol "Lihat Lebih Banyak" -->
                <div class="col-12 mb-lg-4 mb-md-4 mb-5 mt-3">
                    <div class="d-flex align-items-center justify-content-center">
                        <button id="loadMore" class="btn btn-primary rounded-pill d-flex align-items-center gap-2 py-3 px-4" style="font-weight: 500;">
                            Lihat Lebih Banyak <i class="bi bi-arrow-right-circle fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Portfolio Section -->


</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".card-body p").forEach(function(p) {
            let words = p.innerText.split(" "); // Memisahkan teks menjadi array kata
            if (words.length > 19) { // Jika lebih dari 19 kata
                p.innerText = words.slice(0, 19).join(" ") + "..."; // Potong ke 19 kata + "..."
            }
        });
    });
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        let cards = document.querySelectorAll("#cardContainer .col-lg-4, #cardContainer .col-md-6, #cardContainer .col-12");
        let index = 6; // Awalnya tampilkan 3 kartu pertama

        // Sembunyikan kartu kecuali 3 pertama
        cards.forEach((card, i) => {
            if (i >= index) {
                card.classList.add("hidden");
            }
        });

        function showNextCards() {
            let count = 0;
            for (let i = index; i < cards.length && count < 3; i++) {
                cards[i].classList.remove("hidden");
                index++;
                count++;
            }

            // Auto-scroll ke kartu terakhir yang baru muncul
            cards[index - 1].scrollIntoView({
                behavior: "smooth",
                block: "end"
            });

            // Sembunyikan tombol jika semua kartu sudah muncul
            if (index >= cards.length) {
                document.getElementById("loadMore").style.display = "none";
            }
        }

        // Event tombol "Lihat Lebih Banyak"
        document.getElementById("loadMore").addEventListener("click", showNextCards);
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