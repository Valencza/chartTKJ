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
                            <li class="breadcrumb-item"><a href="{{route ('index') }}" class=" text-primary">Profil Anda</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumbs end -->

    <!-- Profile Card start -->
    <section class="profile-card" style="margin-top: -60px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5">
                    <div class="card my-3 shadow-md p-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Kolom Gambar -->
                                <div class="col-md-12 text-center mb-4 pb-1 ">
                                    <img src="{{ Auth::user()->gambar ?? asset('assets/user/img/digireads-assets/default.png') }}"
                                        onerror="this.src='{{ asset('assets/user/img/digireads-assets/default.png') }}';"" alt=" Profile Picture"
                                        class="img-fluid rounded"
                                        style="width: 200px; height: 215px; object-fit: cover; object-position: top;">
                                </div>
                                <!-- Kolom Detail Profile -->
                                <div class="col-md-12">
                                    <h4 class="fw-bold text-center mb-4 pb-1">{{ Auth::user()->nama }}</h4>
                                    <p class="mb-4 pb-2">
                                        <i class="bi bi-envelope-fill me-3 text-primary rounded-circle py-2"
                                            style="background-color: #e3f7ff; padding: 0px 12px;"></i> {{ Auth::user()->email }}
                                    </p>

                                    <p class="mb-4 pb-2">
                                        <i class="bi bi-telephone-fill me-3 text-primary rounded-circle py-2"
                                            style="background-color: #e3f7ff; padding: 0px 12px;"></i> {{ $user->no_telpon ?? '-' }}
                                    </p>

                                    <p class="">
                                        <i class="bi bi-lock-fill me-3 text-primary rounded-circle py-2"
                                            style="background-color: #e3f7ff; padding: 0px 12px;"></i> ********
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-5">
                    <div class="card my-3 shadow-md p-3">
                        <div class="card-body">
                            <h4 class="mb-4 d-flex align-items-center" style="font-weight: 600;">
                                <i class="bi bi-pencil-square text-primary me-3 rounded-circle" style="background-color: #e0efff; padding: 13px 15px;"></i> Edit Profil
                            </h4>

                            <!-- Form -->
                            <form action="{{ route('pengaturan-akun.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                <!-- Upload Foto -->
                                <div class="mb-5 d-flex flex-column flex-sm-row align-items-center">
                                    <label class="form-label mb-lg-0 mb-md-0 mb-3 pb-lg pb-md-0 pb-1 me-3" style="width: 200px; font-weight: 500;">Foto Profil</label>

                                    <div class="position-relative d-inline-block">
                                        <div id="imagePreview" class="image-input-wrapper rounded border shadow d-flex align-items-center justify-content-center"
                                            style="width: 160px; height: 175px; background-size: cover; background-position: top; position: relative;">
                                            <i id="cameraIcon" class="bi bi-image text-secondary text-secondary" style="font-size: 50px; position: absolute;"></i>
                                        </div>

                                        <label class="btn btn-icon btn-circle position-absolute top-100 start-100 translate-middle shadow"
                                            style="width: 35px; height: 35px; background: white; border: none; display: flex; align-items: center; justify-content: center; border-radius: 50%;" title="Ubah Foto">
                                            <i class="bi bi-pencil text-primary"></i>
                                            <input type="file" name="gambar" id="imageUpload" accept=".png, .jpg, .jpeg" class="d-none">
                                        </label>

                                        <button id="removeImage" type="button" class="btn btn-icon btn-circle position-absolute top-0 start-100 translate-middle shadow"
                                            style="width: 35px; height: 35px; background: white; border: none; display: flex; align-items: center; justify-content: center; border-radius: 50%;" title="Hapus Foto">
                                            <i class="bi bi-x text-danger fs-4"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="mb-4 d-flex flex-column flex-sm-row">
                                    <label for="nama" class="form-label me-3" style="width: 200px; font-weight: 500;">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="{{ Auth::user()->nama }}" required autocomplete="off">
                                </div>
                                <div class="mb-4 d-flex flex-column flex-sm-row">
                                    <label for="email" class="form-label me-3" style="width: 200px; font-weight: 500;">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" required autocomplete="off">
                                </div>
                                <div class="mb-4 d-flex flex-column flex-sm-row">
                                    <label for="no_telpon" class="form-label me-3" style="width: 200px; font-weight: 500;">Nomer Telepon</label>
                                    <input type="no_telpon" class="form-control" name="no_telpon" id="no_telpon" value="{{ Auth::user()->no_telpon }}" oninput="formatPhoneNumber(this)" autocomplete="off">
                                </div>
                                <div class="mb-4 d-flex flex-column flex-sm-row">
                                    <label for="password" class="form-label me-3" style="width: 200px; font-weight: 500;">Password Lama</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password lama" autocomplete="off">
                                </div>
                                <div class="mb-4 d-flex flex-column flex-sm-row">
                                    <label for="newPassword" class="form-label me-3" style="width: 200px; font-weight: 500;">Password Baru</label>
                                    <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Masukkan password baru" autocomplete="off">
                                </div>
                                <div class="mb-4 d-flex flex-column flex-sm-row">
                                    <label for="verifikasiPassword" class="form-label me-3" style="width: 200px; font-weight: 500;">Verifikasi Password</label>
                                    <input type="password" class="form-control" name="verifikasiPassword" id="verifikasiPassword" placeholder="Verifikasi password baru" autocomplete="off">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary py-2 mt-2">Simpan Perubahan</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Profile Card end -->

</main>

<!-- js gambar -->
<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Ambil file yang dipilih
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').style.backgroundImage = `url(${e.target.result})`;
                document.getElementById('cameraIcon').style.display = 'none'; // Sembunyikan ikon kamera
            };
            reader.readAsDataURL(file); // Konversi gambar ke URL untuk preview
        }
    });

    // Fungsi untuk menghapus gambar
    document.getElementById('removeImage').addEventListener('click', function() {
        const imagePreview = document.getElementById('imagePreview');
        const cameraIcon = document.getElementById('cameraIcon');

        // Reset background dan tampilkan ikon kamera
        imagePreview.style.backgroundImage = 'none';
        cameraIcon.style.display = 'block'; // Tampilkan ikon kamera

        // Reset input file
        document.getElementById('imageUpload').value = '';
    });
</script>

<script>
function formatPhoneNumber(input) {
    let value = input.value.replace(/\D/g, ''); // Hanya angka
    if (value.length > 4 && value.length <= 8) {
        value = value.replace(/(\d{4})(\d+)/, '$1-$2');
    } else if (value.length > 8) {
        value = value.replace(/(\d{4})(\d{4})(\d+)/, '$1-$2-$3');
    }
    input.value = value;
}
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