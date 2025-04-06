@extends ('home.layouts.app')

@section ('content')

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
    <section id="detail-portfolio" class="detail-portfolio section" style="margin-top: -60px;">
        <div class="container d-flex justify-content-center align-items-center">
            <div class="col-lg-10 col-md-10 col-11">
                <div class="card shadow p-4">
                    <img src="{{ asset('storage/' . $portofolioDetail->gambar) }}"
                        alt="{{ $portofolioDetail->nama }}"
                        class="img-fluid w-100 object-fit-cover mb-4 rounded"
                        style="max-height: 500px; height: auto;">

                    <h3 class="fw-bold fs-lg-1 fs-md-2 fs-4">{{ $portofolioDetail->nama }}</h3>
                    <p class="text-muted fs-lg-4 fs-md-5 fs-6">
                        {{ $portofolioDetail->nama }}
                    </p>

                    <h5 class="mt-4 fw-bold fs-lg-3 fs-md-4 fs-5">Detail Pekerjaan:</h5>
                    <ul class="fs-lg-4 fs-md-5 fs-6">
                        @php $details = json_decode($portofolioDetail->detail, true); @endphp

                        @if (is_array($details))
                        @foreach ($details as $detail)
                        <li>{{ ucfirst($detail) }}</li>
                        @endforeach
                        @else
                        <li>Detail tidak tersedia</li>
                        @endif
                    </ul>

                    <h5 class="mt-4 fw-bold fs-lg-3 fs-md-4 fs-5">Kenapa Memilih Kami?</h5>
                    <p class="fs-lg-4 fs-md-5 fs-6">
                        Kami memberikan layanan cepat, harga terjangkau, serta garansi servis untuk memastikan kepuasan pelanggan.
                    </p>

                    <div class="mt-4">
                        <div class="col-lg-12 col-md-8 col-12">
                            <div class="d-lg-flex d-md-flex d-flex-none detail-pc align-items-center">
                                <a href="{{ route('portofolio.index') }}" class="btn btn-primary d-flex align-items-center gap-2 me-lg-2 me-md-2 me-0 mb-lg-0 mb-md-0 mb-2">
                                    <i class="bi bi-arrow-left-circle fs-5 ms-1"></i> Kembali
                                </a>
                                <a href="#" class="btn text-white d-flex align-items-center gap-2" style="background-color: #25D366;">
                                    <i class="bi bi-whatsapp fs-5 ms-1"></i> Hubungi Kami
                                </a>
                            </div>
                        </div>
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