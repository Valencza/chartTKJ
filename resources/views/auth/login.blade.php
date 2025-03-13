@extends('auth.layouts.app')

@section('content')

<div class="container-fluid login-page">
    <a href="{{route ('index') }}" class="home-button">
        <i class="bi bi-house-fill"></i>
    </a>
    <div class="row w-100">
        <div class="col-xxl-6 col-lg-6 d-flex align-items-center justify-content-center">
            <div class="login-form">
                <img src="{{asset ('assets/user/img/logo.svg') }}" alt="Logo" class=" mt-5 mb-2 img-fluid" style="max-width: 160px;">
                <h4 class="mb-2 mt-3 text-dark">Masuk ke Akun Kamu</h4>
                <p class="text-secondary">Selamat datang di ChartTKJ !</p>
                <form action="{{route ('login') }}" id="loginForm" class="mt-4 pt-2" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-4 pb-2">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="d-flex justify-content-between mt-4 mb-4 pb-2">
                        <div class="remember-me">
                            <input type="checkbox" id="rememberMe">
                            <label for="rememberMe" class="form-check-label">Ingatkan Saya</label>
                        </div>
                        <a href="#" class="text-decoration-none forgot">Lupa Password ?</a>
                    </div>
                    <button type="submit" id="loginButton" class="btn btn-primary w-100 mb-2 rounded-pill">Masuk</button>
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
                        <p class="text-secondary akun">Belum punya akun ? <a href="{{route ('formRegister') }}" class="text-primary">Daftar dulu</a></p>
                    </div>
            </div>
        </div>
        <div class="col-xxl-6 col-lg-6 illustration text-center">
            <img src="{{asset ('assets/user/img/digireads-assets/sign in up-il.svg') }}" class="img-fluid" alt="">
        </div>
    </div>
</div>

  <!-- <script>
    document.addEventListener("DOMContentLoaded", function () {
      const loginForm = document.querySelector('form');
      loginForm.addEventListener('submit', function (event) {
        event.preventDefault();  // Mencegah pengiriman form

        const submitButton = document.querySelector('.btn-primary');
        submitButton.innerHTML = 'Memuat...';
        submitButton.disabled = true; // Menonaktifkan tombol selama proses login

        setTimeout(function () {
          Swal.fire({
            icon: 'success',
            title: 'Login Berhasil !',
            text: 'Selamat datang di ChartTkj !',
            showConfirmButton: false,
            timer: 2000,
            didClose: () => {
              window.location.href = "{{route ('index') }}";  // Sesuaikan dengan halaman tujuan
              loginForm.reset();  // Reset form setelah login berhasil
            }
          });
        }, 2000); // Simulasi delay 2 detik
      });
    });
  </script> -->

@endsection