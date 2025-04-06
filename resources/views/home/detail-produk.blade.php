@extends('home.layouts.app')

@section('content')

<style>
  .custom-width td:first-child {
    width: 40%;
    white-space: nowrap;
  }

  .custom-width td:last-child {
    width: 60%;
    word-wrap: break-word;
    max-width: 200px;
  }

  .icon-text {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .table {
    min-width: 600px;
  }

  .table td,
  .table th {
    white-space: normal;
  }

  .custom-width td:first-child {
    width: 40%;
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
    max-width: 150px;
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
                <a href="{{route ('index') }}" class="text-secondary">
                  <i class="bi bi-house-door icon" style="font-size: 19px;"></i>
                </a>
              </li>
              <li class="breadcrumb-item active" aria-current="page"><a href="{{route ('pembelian') }}" class="text-secondary">Pembelian</a< /li>
              <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('detail-produk', ['slug' => $produk->slug]) }}" class="active">Detail Barang</a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumbs end -->

  <!-- detail start -->
  <section id="detail-produk" class="detail-produk detail section">
    <div class="container">
      <div class="row d-flex align-items-stretch">
        <!-- Column 1: Gambar Produk -->
        <div class="col-lg-6 mb-lg-4 mb-5 mb-4">
          <div class="card p-5 h-100 d-flex justify-content-center align-items-center">
            <img src="{{ asset($produk->gambar) }}" class="card-img-top img-fluid" alt="{{ $produk->nama }}">
          </div>
        </div>

        <!-- Column 2: Info Produk -->
        <div class="col-lg-6 mb-4">
          <div class="card py-lg-4 px-lg-5 py-4 px-4 h-100">
            <h4 class="card-title mb-3">{{ $produk->nama }}</h4>
            <p class="card-text text-secondary mb-2">{{ $produk->deskripsi }}</p>
            <hr>
            <!-- Rating dan Jumlah Terjual -->
            <div class="d-flex justify-content-between my-2">
              <div>
                @php
                $roundedRating = floor($totalRating); // Ambil angka bulat ke bawah
                $hasHalfStar = ($totalRating - $roundedRating) >= 0.5; // Cek apakah ada bintang setengah
                $totalReviews = \App\Models\Ulasan::where('id_produk', $produk->id)->count(); // Hitung total ulasan
                @endphp

                @for ($i = 1; $i <= 5; $i++)
                  @if ($i <=$roundedRating)
                  <i class="bi bi-star-fill text-warning"></i> <!-- Bintang Penuh -->
                  @elseif ($hasHalfStar && $i == $roundedRating + 1)
                  <i class="bi bi-star-half text-warning"></i> <!-- Bintang Setengah -->
                  @php $hasHalfStar = false; @endphp <!-- Hanya satu bintang setengah -->
                  @else
                  <i class="bi bi-star text-muted"></i> <!-- Bintang Kosong -->
                  @endif
                  @endfor
                  <span class="ms-2 text-muted">({{ $totalReviews }})</span>
              </div>
              <div>
                <span class="text-primary" style="font-weight: 500;">Jumlah Terjual: {{ $produk->stok_out }}</span>
              </div>
            </div>

            <!-- Harga dan Sisa Stok -->
            <div class="mt-2">
              <h4 class="fs-4">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h4>
            </div>
            <div>
              <p class="text-secondary">Sisa Stok: {{ $produk->stok_in }}</p>
            </div>

            <!-- Jumlah dan Tombol Beli -->
            <div class="d-flex justify-content-between align-items-center mt-3">
              <form action="{{ route('checkout', ['slug' => $produk->slug]) }}" method="GET" id="checkoutForm">
                <div class="d-flex align-items-center">
                  <button type="button" class="btn btn-primary fw-bold" id="decrease">-</button>
                  <input type="number" class="form-control mx-2" name="jumlah" id="jumlah_produk" style="width: 50px;" value="1" min="1" max="{{ $produk->stok_in }}">
                  <button type="button" class="btn btn-primary fw-bold" id="increase">+</button>
                </div>
            </div>
            <div class="mt-4 pt-3 button-card d-flex">
              <button type="submit" class="btn btn-primary rounded-pill mb-lg-0 mb-md-0 mb-3" id="beliButton">Beli Sekarang</button>
              </form>
              <button class="btn btn-outline-primary rounded-pill ms-2 d-flex align-items-center justify-content-center" data-bs-toggle="modal" data-bs-target="#spesifikasiModal">
                <i class="bi bi-info-circle me-2"></i>
                <span>Spesifikasi</span>
              </button>
              <button id="keranjangButton" class="btn btn-outline-primary text-center rounded-pill ms-lg-2 ms-md-3 mb-lg-0 mb-md-0 mb-3 d-flex align-items-center justify-content-center">
                <i class="bi bi-cart3 me-2"></i>
                <span id="keranjangText" style="font-weight: 600;">Keranjang</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- detail end -->

  <!-- rating-barang start -->
  <section id="rating-barang" class="rating-barang" style="padding-bottom: 75px;">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card py-lg-4 px-lg-5 py-4 px-4">
            <div class="row">
              <div class="col-lg-4 col-md-6 text-center mb-lg-0 mb-md-4 mb-5">
                <h5 class="">Kirim Ulasan</h5>
                <h5 class="">Untuk Produk Ini</h5>
                <!-- Filter untuk ulasan -->
                <button class="btn btn-primary rounded-pill px-4 mt-3" data-bs-toggle="modal" data-bs-target="#writeReviewModal" style="font-weight: 500;padding: 10px 0px;">Tulis Ulasan</button>
              </div>
              <div class="col-lg-4 col-md-6 text-center mb-lg-0 mb-md-4 mb-4">
                <h5 class="">Rating Barang</h5>
                <div class="d-flex justify-content-center align-items-center pt-4">
                  @php
                  $totalRating = \App\Models\Ulasan::where('id_produk', $produk->id)->avg('rating') ?? 0; // Ambil rata-rata rating
                  $roundedRating = floor($totalRating); // Ambil angka bulat ke bawah
                  $hasHalfStar = ($totalRating - $roundedRating) >= 0.5; // Cek apakah ada bintang setengah
                  $totalReviews = \App\Models\Ulasan::where('id_produk', $produk->id)->count(); // Hitung total ulasan
                  @endphp

                  <h1 class="me-3 mt-1 fs-1">{{ number_format($totalRating, 1) }}</h1>
                  <div>
                    @for ($i = 1; $i <= 5; $i++)
                      @if ($i <=$roundedRating)
                      <span class="bi bi-star-fill text-warning"></span> <!-- Bintang Penuh -->
                      @elseif ($hasHalfStar && $i == $roundedRating + 1)
                      <span class="bi bi-star-half text-warning"></span> <!-- Bintang Setengah -->
                      @php $hasHalfStar = false; @endphp <!-- Pastikan hanya satu bintang setengah -->
                      @else
                      <span class="bi bi-star text-muted"></span> <!-- Bintang Kosong -->
                      @endif
                      @endfor
                  </div>
                </div>
                <p class="text-secondary ulas mt-1">Berdasarkan dari {{ $totalReviews }} Pelanggan</p>
              </div>

              <div class="col-lg-4 col-md-12">
                <h5 class="text-center mb-3">Statistik Rating</h5>

                @php
                // Ambil total ulasan per rating (1-5)
                $ratingCounts = \App\Models\Ulasan::where('id_produk', $produk->id)
                ->selectRaw('rating, COUNT(*) as total')
                ->groupBy('rating')
                ->pluck('total', 'rating')->toArray();

                // Total semua ulasan
                $totalReviews = array_sum($ratingCounts);

                // Fungsi untuk menghitung persentase
                function getPercentage($count, $total) {
                return $total > 0 ? ($count / $total) * 100 : 0;
                }
                @endphp

                @for ($i = 5; $i >= 1; $i--)
                @php
                $count = $ratingCounts[$i] ?? 0; // Ambil jumlah ulasan untuk rating tertentu
                $percentage = getPercentage($count, $totalReviews);
                @endphp
                <div class="d-flex align-items-center mt-2">
                  <span class="text-muted me-2">{{ $i }}</span>
                  <div class="progress w-100">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $percentage }}%;"
                      aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <span class="text-muted ms-2">{{ $count }}</span>
                </div>
                @endfor
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- rating-barang end -->

  <!-- Testimoni start -->
  <section id="testimonials" class="testimonials section light-background">
    <div class="container my-3">
      <div class="col-12 mb-4 text-center">
        <h1 class="fs-3 mt-0 heading">Ulasan Pelanggan</h1>
        <p class="mb-5 pt-1 sub-heading text-secondary">Pengalaman pengguna dalam menggunakan Platform Kami</p>
      </div>

      @php
      // Ambil semua ulasan untuk produk tertentu
      $ulasan = \App\Models\Ulasan::where('id_produk', $produk->id)->get();
      @endphp

      @if($ulasan->count() > 0)
      <div id="testimonialCarousel" class="carousel slide te" data-bs-ride="carousel">
        <div class="carousel-inner">
          @foreach($ulasan->chunk(3) as $index => $ulasanChunk)
          <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            <div class="row g-4">
              @foreach($ulasanChunk as $review)
              <div class="col-lg-4 col-md-6" data-aos-delay="50">
                <div class="testimonial-item">
                  <img src="{{ $review->user->gambar ? asset( $review->user->gambar) : asset('assets/user/img/digireads-assets/default.png') }}"
                    onerror="this.src='{{ asset('assets/user/img/digireads-assets/default.png') }}';"
                    class="testimonial-img" alt="{{ $review->user->nama }}">
                  <h3>{{ $review->user->nama }}</h3>
                  <div class="stars">
                    @for ($i = 1; $i <= 5; $i++)
                      <i class="bi {{ $i <= $review->rating ? 'bi-star-fill text-warning' : 'bi-star text-muted' }}"></i>
                      @endfor
                  </div><br>
                  <div class="testimonial-date mt-3 text-secondary d-flex">
                    <i class="bi bi-calendar-event"></i>
                    <div class="ms-2">
                      <span>{{ \Carbon\Carbon::parse($review->created_at)->format('d F Y') }}</span>
                    </div>
                  </div>
                  <p class="mt-2 testimonial-description">
                    <i class="bi bi-quote quote-icon-left"></i>
                    "{{ $review->deskripsi }}"
                    <i class="bi bi-quote quote-icon-right"></i>
                  </p>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
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
      @else
      <p class="text-center text-muted">Belum ada ulasan untuk produk ini.</p>
      @endif
    </div>
  </section>

  <!-- Testimoni End -->
  <div class="modal fade" id="writeReviewModal" tabindex="-1" aria-labelledby="writeReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md">
      <form id="reviewForm" action="{{ route('ulasan.store', ['slug' => $produk->slug]) }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="writeReviewModalLabel" style="font-weight: 600;font-family: 'Poppins';">Tulis Ulasan Anda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body ">
            <!-- Form untuk menulis ulasan -->
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="mb-3">
              <label class="text-secondary" style="font-weight: 500;">Beri Rating : </label>
              <div class="rating" style="font-size: 30px;">
                <span class="star" data-value="1">&#9733;</span>
                <span class="star" data-value="2">&#9733;</span>
                <span class="star" data-value="3">&#9733;</span>
                <span class="star" data-value="4">&#9733;</span>
                <span class="star" data-value="5">&#9733;</span>
              </div>
            </div>
            <div class="mb-3">
              <label for="deskripsi" class="form-label text-secondary" style="font-weight: 600;font-family:'Poppins';">Ulasan Anda</label>
              <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" placeholder="Tulis ulasan Anda di sini..." required></textarea>
            </div>
            <input type="hidden" name="rating" id="rating" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" style="font-family: 'Poppins', sans-serif;" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" id="submitUlasan" style="font-family: 'Poppins', sans-serif;">Kirim Ulasan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</main>

<!-- Modal Spesifikasi -->
<div class="modal fade" id="spesifikasiModal" tabindex="-1" aria-labelledby="spesifikasiModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title d-flex align-items-center" id="spesifikasiModalLabel">
          <i class="bi bi-info-circle me-2 text-primary rounded-circle fs-5" style="background-color: #e3f7ff; padding: 9px 14px;"></i>
          Spesifikasi Produk
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered custom-width">
            <tbody>
              @foreach (json_decode($produk->spesifikasi, true) as $key => $value)
              <tr>
                <td>
                  <div class="icon-text">
                    <i class="bi bi-check-circle-fill text-primary"></i>
                    <span>{{ ucfirst($key) }}</span>
                  </div>
                </td>
                <td>{{ $value }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
  document.getElementById('beliButton').addEventListener('click', function(event) {
    const stokIn = {
      {
        $produk - > stok_in
      }
    };
    const jumlahInput = document.getElementById('jumlah_produk');
    const jumlah = parseInt(jumlahInput.value);

    if (stokIn === 0) {
      event.preventDefault(); // Prevent form submission
      alert("Produk stok habis!");
    } else if (jumlah > stokIn) {
      event.preventDefault(); // Prevent form submission
      alert("Jumlah pembelian melebihi stok yang tersedia!");
    }
  });
</script>

<script>
  const stars = document.querySelectorAll('.star');
  let rating = 0;

  stars.forEach(star => {
    star.addEventListener('click', function() {
      rating = this.getAttribute('data-value');
      document.getElementById('rating').value = rating;
      updateStars();
    });

    star.addEventListener('mouseover', function() {
      highlightStars(this.getAttribute('data-value'));
    });

    star.addEventListener('mouseout', function() {
      updateStars();
    });
  });

  function updateStars() {
    stars.forEach(star => {
      const value = star.getAttribute('data-value');
      star.style.color = value <= rating ? "#ffcc00" : "#ccc";
    });
  }

  function highlightStars(value) {
    stars.forEach(star => {
      star.style.color = star.getAttribute('data-value') <= value ? "#ffcc00" : "#ccc";
    });
  }

  document.getElementById('submitUlasan').addEventListener('click', function(event) {
    console.log('Button clicked'); // Debugging

    event.preventDefault();
    console.log('Form submission prevented'); // Cek apakah event preventDefault bekerja

    const reviewForm = document.getElementById('reviewForm');
    const formData = new FormData(reviewForm);

    console.log('Rating:', formData.get('rating'));
    console.log('Deskripsi:', formData.get('deskripsi'));

    if (document.getElementById('deskripsi').value.trim() && document.getElementById('rating').value > 0) {
      console.log('Data valid, menampilkan SweetAlert');

      Swal.fire({
        icon: 'warning',
        title: 'Konfirmasi Pengiriman',
        text: 'Apakah Anda yakin ingin mengirim ulasan ini?',
        showCancelButton: true,
        confirmButtonText: 'Kirim',
        cancelButtonText: 'Batal',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-secondary'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          console.log('User confirmed submission');

          fetch(reviewForm.action, {
              method: 'POST',
              body: formData,
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
              }
            })
            .then(response => response.json())
            .then(data => {
              console.log('Response:', data);

              Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message || 'Ulasan Anda telah terkirim.',
                confirmButtonText: 'OK'
              }).then(() => {
                reviewForm.reset();
                rating = 0;
                updateStars();
                $('#writeReviewModal').modal('hide');
              });
            })
            .catch(error => {
              console.error('Error:', error);
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat mengirim ulasan.',
                confirmButtonText: 'OK'
              });
            });
        } else {
          console.log('User canceled submission');
        }
      });
    } else {
      console.log('Form tidak valid, menampilkan pesan error');

      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Pastikan Anda memberikan rating dan ulasan.',
        confirmButtonText: 'OK'
      });
    }
  });


  $('#writeReviewModal').on('hidden.bs.modal', function() {
    document.getElementById('reviewForm').reset();
    rating = 0;
    updateStars();
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    let jumlahInput = document.getElementById("jumlah_produk");
    let decreaseBtn = document.getElementById("decrease");
    let increaseBtn = document.getElementById("increase");

    // Tambahkan event listener untuk tombol "-"
    decreaseBtn.addEventListener("click", function(event) {
      event.preventDefault();
      let currentValue = parseInt(jumlahInput.value);
      if (currentValue > 1) {
        jumlahInput.value = currentValue - 1;
      }
    });

    // Tambahkan event listener untuk tombol "+"
    increaseBtn.addEventListener("click", function(event) {
      event.preventDefault();
      let currentValue = parseInt(jumlahInput.value);
      jumlahInput.value = currentValue + 1;
    });
  });
</script>

<!-- js droopdown -->
<script>
  // Event handler untuk item dropdown
  document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
      var selectedText = this.textContent; // Ambil teks dari item yang dipilih
      document.getElementById('dropdownMenuButton').textContent = selectedText; // Ubah teks tombol
    });
  });
</script>

<!-- js keranjang -->
<script>
  document.getElementById('keranjangButton').addEventListener('click', function() {
    document.getElementById('keranjangText').textContent = 'Memproses';

    const spinner = document.createElement('div');
    spinner.classList.add('spinner');
    document.getElementById('keranjangButton').appendChild(spinner);

    setTimeout(function() {
      spinner.remove();
      document.getElementById('keranjangText').textContent = 'Keranjang';

      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Barang sudah ditambahkan ke keranjang.',
        confirmButtonText: 'OK'
      });
    }, 2000);
  });
</script>


@endsection