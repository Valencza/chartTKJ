<!-- Header / Nav Start -->
@if(Auth::check())
<header id="header" class="header d-flex align-items-center fixed-top">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top mt-4">
    <div class="container">
      <a class="navbar-brand logo d-flex align-items-center me-auto me-xl-0"
        href="#">
        <img src="" alt class="img-fluid">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="d-flex profile ms-2">
        <div class="dropdown">
          <a class="btn p-0" href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ Auth::user()->gambar ?? asset('assets\user\img\digireads-assets\default.png') }}"
              onerror="this.src='{{ asset('assets/user/img/digireads-assets/default.png') }}';"
              alt="Profile"
              class="rounded-circle profile-img"
              width="60"
              height="60">
          </a>
          <div class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="profileDropdown">
            <div class="d-flex align-items-center mb-3">
              <img src="{{ Auth::user()->gambar ?? asset('assets/user/img/digireads-assets/default.png') }}"
                onerror="this.src='{{ asset('assets/user/img/digireads-assets/default.png') }}';"
                alt="Profile"
                class="rounded-circle me-3 profile-img"
                width="50" height="50">
              <div>
                <div class="fw-bold d-flex align-items-center fs-6">
                  {{ Auth::user()->nama ?? 'Nama Tidak Tersedia' }}
                </div>
                <a href="#" class="text-muted text-hover-primary fs-7">
                  {{ Auth::user()->email ?? 'Email Tidak Tersedia' }}
                </a>
              </div>
            </div>
            <hr class="dropdown-divider">
            <a class="dropdown-item py-2" href="{{route ('riwayat') }}">Riwayat</a>
            <a class="dropdown-item py-2" data-bs-toggle="modal" data-bs-target="#notifikasiModal">Notifikasi</a>
            <a class="dropdown-item py-2" href="{{route ('pengaturan-akun') }}">Pengaturan Akun</a>
            <a class="dropdown-item py-2" data-bs-toggle="modal" data-bs-target="#alamatModal">
              Pengaturan Alamat
            </a>
            <hr class="dropdown-divider">
            <a href="#" class="dropdown-item py-2"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Keluar
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </div>
      </div>
      <div class="collapse navbar-collapse custom" id="navbarSupportedContent">
        <ul class="navbar-nav custom mx-auto mb-2 mb-lg-0 justify-content-center">
          <li>
            <a class="nav-link mx-xxl-3 mx-md-0 mx-0 {{ Request::is('/') ? 'active' : '' }}"
              href="{{ route('index') }}">Beranda
            </a>
          </li>
          <li>
            <a class="nav-link mx-xxl-3 mx-md-0 mx-0 {{ Request::is('pembelian') ? 'active' : '' }}"
              href="{{ route('pembelian') }}">Pembelian
            </a>
          </li>
          <li>
            <a class="nav-link mx-xxl-3 mx-md-0 mx-0 {{ Request::is('service') ? 'active' : '' }}"
              href="{{route ('service') }}">Layanan</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

@else

<header id="header" class="header d-flex align-items-center fixed-top">
  <nav class="navbar navbar-expand-lg navbar-light fixed-top mt-4">
    <div class="container">
      <a class="navbar-brand logo d-flex align-items-center me-auto me-xl-0"
        href="{{route ('index') }}">
        <img src="{{asset ('assets/user/img/LOGO.svg') }}" alt class="img-fluid">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse custom" id="navbarSupportedContent">
        <ul class="navbar-nav custom mx-auto mb-2 mb-lg-0 justify-content-center">
          <li>
            <a class="nav-link mx-xxl-3 mx-md-0 mx-0 {{ Request::is('/') ? 'active' : '' }}"
              href="{{ route('index') }}">Beranda
            </a>
          </li>
          <li>
            <a class="nav-link mx-xxl-3 mx-md-0 mx-0 {{ Request::is('pembelian') ? 'active' : '' }}"
              href="{{ route('pembelian') }}">Pembelian
            </a>
          </li>
          <li>
            <a class="nav-link mx-xxl-3 mx-md-0 mx-0 {{ Request::is('service') ? 'active' : '' }}"
              href="{{route ('service') }}">Layanan</a>
          </li>
        </ul>
        <div class="d-flex button-masuk">
          <a class="btn btn-primary btn-1 rounded-pill text-white me-2"
            href="{{route ('formRegister') }}" role="button">Daftar</a>
          <a class="btn btn-outline-primary btn-2 rounded-pill"
            href="{{route ('formLogin') }}">Masuk</a>
        </div>
      </div>
    </div>
  </nav>
</header>
@endif

<!-- Header / Nav End-->