<script src="{{ asset('/sw.js') }}"></script>

<script>
  if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("/sw.js").then(
      (registration) => {
        console.log("Service worker registration succeeded:", registration);
      },
      (error) => {
        console.error(`Service worker registration failed: ${error}`);
      },
    );
  } else {
    console.error("Service workers are not supported.");
  }
</script>

<script>
  const logo = document.getElementById('responsive-logo');
  const updateLogo = () => {
    if (window.innerWidth <= 768) {
      logo.src = "{{asset('assets/user/img/logo.png')}}";
    } else {
      logo.src = "{{asset('assets/user/img/logo-text.png')}}";
    }
  };

  // Jalankan fungsi saat halaman dimuat dan saat jendela diubah ukurannya
  window.addEventListener('load', updateLogo);
  window.addEventListener('resize', updateLogo);
</script>

<script>
  // Mendapatkan elemen tombol dan input
  const increaseBtn = document.getElementById('increase');
  const decreaseBtn = document.getElementById('decrease');
  const quantityInput = document.getElementById('quantity');

  // Fungsi untuk menambah jumlah
  increaseBtn.addEventListener('click', function() {
    let currentValue = parseInt(quantityInput.value);
    if (!isNaN(currentValue)) {
      quantityInput.value = currentValue + 1;
    }
  });

  // Fungsi untuk mengurangi jumlah
  decreaseBtn.addEventListener('click', function() {
    let currentValue = parseInt(quantityInput.value);
    if (!isNaN(currentValue) && currentValue > 1) {
      quantityInput.value = currentValue - 1;
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

<!-- <script>

    const stars = document.querySelectorAll('.star');
    let rating = 0;

    stars.forEach(star => {
        star.addEventListener('click', function() {
            rating = this.getAttribute('data-value');
            updateStars();
        });

        star.addEventListener('mouseover', function() {
            this.classList.add('hover');
        });

        star.addEventListener('mouseout', function() {
            this.classList.remove('hover');
        });
    });

    function updateStars() {
        stars.forEach(star => {
            const value = star.getAttribute('data-value');
            if (value <= rating) {
                star.style.color = "#ffcc00"; // Warna bintang yang dipilih
            } else {
                star.style.color = "#ccc"; // Warna bintang yang tidak dipilih
            }
        });
    }

    // Menangani pengiriman ulasan
    const submitButton = document.getElementById('submitReview');
    submitButton.addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah form dikirim secara default

        // Mendapatkan nilai ulasan
        const reviewText = document.getElementById('reviewText').value;

        if (reviewText && rating > 0) {
            // Jika ulasan ada dan rating sudah dipilih
            Swal.fire({
                icon: 'success',
                title: 'Ulasan Anda Telah Terkirim',
                text: 'Terima kasih atas ulasan Anda!',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'  // Tombol warna biru
                },
                // Styling font untuk SweetAlert
                didOpen: () => {
                    Swal.getPopup().style.fontFamily = 'Poppins, sans-serif';
                }
            }).then(() => {
                // Setelah menutup SweetAlert, reset form
                document.getElementById('reviewForm').reset(); // Reset form
                updateStars(); // Reset rating
                $('#writeReviewModal').modal('hide'); // Menutup modal secara otomatis
            });
        } else {
            // Jika rating atau ulasan kosong
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pastikan Anda memberikan rating dan ulasan.',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'  // Tombol warna biru
                },
                // Styling font untuk SweetAlert
                didOpen: () => {
                    Swal.getPopup().style.fontFamily = 'Poppins, sans-serif';
                }
            });
        }
    });

    // Menangani penutupan modal, reset form jika modal ditutup tanpa mengirim ulasan
    $('#writeReviewModal').on('hidden.bs.modal', function () {
        document.getElementById('reviewForm').reset();  // Reset form saat modal ditutup
        updateStars(); // Reset rating
    });

</script> -->

<script>
  // Event handler untuk item dropdown
  document.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', function() {
      var selectedText = this.textContent; // Ambil teks dari item yang dipilih
      document.getElementById('dropdownMenuButton').textContent = selectedText; // Ubah teks tombol
    });
  });
</script>

<script>
  document.getElementById('keranjangButton').addEventListener('click', function() {
    // Ganti teks button menjadi "Memproses"
    document.getElementById('keranjangText').textContent = 'Memproses';

    // Tambahkan spinner loading
    const spinner = document.createElement('div');
    spinner.classList.add('spinner');
    document.getElementById('keranjangButton').appendChild(spinner);

    // Setelah 2 detik, tampilkan SweetAlert
    setTimeout(function() {
      // Hapus spinner
      spinner.remove();

      // Ganti teks menjadi "Keranjang" lagi
      document.getElementById('keranjangText').textContent = 'Keranjang';

      // Tampilkan SweetAlert
      Swal.fire({
        icon: 'success',
        title: 'Berhasil',
        text: 'Barang sudah ditambahkan ke keranjang.',
        confirmButtonText: 'OK'
      });
    }, 2000);
  });
</script>

<!-- pengaturan alamat -->

<!-- js modal -->
<script>
  function simpanAlamat() {
    // Ambil semua elemen input form
    var inputs = document.querySelectorAll('#tambahAlamatModal input, #tambahAlamatModal textarea');
    var isFormValid = true;

    // Periksa apakah semua input sudah terisi
    inputs.forEach(function(input) {
      if (input.value.trim() === '') {
        isFormValid = false;
      }
    });

    if (!isFormValid) {
      // Jika ada yang kosong, tampilkan alert untuk pengisian semua field
      Swal.fire({
        title: "Semua field harus diisi",
        text: "Pastikan semua kolom terisi sebelum menyimpan.",
        icon: "error",
        confirmButtonText: "OK"
      });
    } else {
      // Setelah berhasil disimpan, tampilkan alert sukses
      Swal.fire({
        title: "Alamat Tersimpan",
        text: "Alamat baru Anda telah berhasil disimpan.",
        icon: "success",
        confirmButtonText: "OK"
      }).then(() => {
        // Reset semua input setelah berhasil disimpan
        document.getElementById("alamatForm").reset();

        // Tutup modal setelah data disimpan
        var modalElement = document.getElementById('tambahAlamatModal');
        var modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) {
          modalInstance.hide();
        }
      });
    }
  }

  // Tambahkan event listener untuk tombol batal agar mereset form
  document.getElementById("batalButton").addEventListener("click", function() {
    document.getElementById("alamatForm").reset();
  });
</script>
<!-- js text area -->
<script>
  document.getElementById("alamatLengkap").placeholder = "Masukkan alamat lengkap\n(Kota, Kecamatan, Provinsi, Kode Pos)";
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

<!-- end pengaturan alamat -->

<!-- Vendor JS Files -->
<script src="{{asset ('assets/user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset ('assets/user/vendor/php-email-form/validate.js') }}"></script>
<script src="{{asset ('assets/user/vendor/aos/aos.js') }}"></script>
<script src="{{asset ('assets/user/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{asset ('assets/user/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{asset ('assets/user/vendor/purecounter/purecounter_vanilla.js') }}"></script>

<!-- CDN Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Main JS File -->
<script src="{{asset ('assets/user/js/main.js') }}"></script>

</body>

</html>