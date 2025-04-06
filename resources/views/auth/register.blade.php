@extends('auth.layouts.app')

@section('content')

<div class="container-fluid buat-page">
  <a href="{{route ('index') }}" class="home-button">
    <i class="bi bi-house-fill"></i>
  </a>
  <div class="row w-100">
    <div class="col-xxl-6 col-lg-6 d-flex align-items-center justify-content-center">
      <div class="login-form mt-4">
        <img src="{{asset ('assets/user/img/LOGO.svg') }}" alt="Logo" class="mb-2 mt-5" style="max-width: 160px;">
        <h4 class="mb-2 mt-3 text-dark text-start">Daftar untuk Mulai</h4>
        <p class="text-secondary mb-4 text-start">Selamat datang di ChartTKJ !</p>
        <form action="{{route ('register') }}" id="registForm" method="POST">
          @csrf
          <div class="mb-3">
            <input type="text" name="nama" class="form-control" placeholder="Nama" required pattern="[A-Za-z\s]+" title="Hanya huruf dan spasi yang diperbolehkan">
          </div>
          <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="mb-4">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <div class="remember-me">
              <input type="checkbox" id="rememberMe" required>
              <label for="rememberMe" class="form-check-label">Terima syarat dan ketentuan</label>
            </div>
          </div>
          <button type="submit" id="registButton" class="btn btn-primary w-100 mt-3 mb-2 rounded-pill">Daftar</button>
        </form>

        <!-- Tombol Masuk dengan Google -->
        <div class="google-login d-flex align-items-center justify-content-center py-2 mt-3 mb-2 rounded-pill">
          <a href="{{route ('google') }}" style="text-decoration: none; display: flex; align-items: center; color: inherit;">
            <img src="{{asset ('assets/user/img/digireads-assets/google logo.svg') }}" class="img-fluid" alt="Google Logo"
              style="width: 20px; height: 20px; margin-right: 10px;">
            <span>Masuk dengan Google</span>
          </a>
        </div>
        <div class="text-center mt-3">
          <p class="text-secondary akun">Sudah punya akun ? <a href="{{route ('formLogin') }}" class="text-primary">Masuk</a></p>
        </div>
      </div>
    </div>
    <div class="col-xxl-6 col-lg-6 illustration text-center ">
      <img src="{{asset ('assets/user/img/digireads-assets/sign in up-il.svg') }}" class="img-fluid" alt="">
    </div>
  </div>
</div>

<!-- <script>
  document.addEventListener("DOMContentLoaded", function() {
    const registForm = document.querySelector('#registForm');

    registForm.addEventListener('submit', function(event) {
      event.preventDefault();

      const formData = new FormData(registForm);

      fetch("{{ route('register') }}", {
          method: "POST",
          body: formData,
          headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          }
        })
        .then(response => response.json())
        .then(data => {
          if (data.errors) {
            let errorMessages = Object.values(data.errors).join(', ');
            Swal.fire({
              icon: 'error',
              title: 'Gagal!',
              text: errorMessages,
            });
          } else {
            Swal.fire({
              icon: 'success',
              title: 'Pendaftaran Berhasil!',
              text: 'Akan diarahkan ke halaman login...',
            }).then(() => {
              window.location.href = data.redirect;
            });
          }
        })
        .catch(error => {
          Swal.fire({
            icon: 'error',
            title: 'Kesalahan Server',
            text: 'Silakan coba lagi nanti',
          });
          console.error('Error:', error);
        });
    });
  });
</script> -->

@endsection