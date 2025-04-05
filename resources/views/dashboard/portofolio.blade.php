@extends('dashboard.layouts.app')

@section('content')

<!--start content-->
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input type="text" table-search="search"
                            class="form-control form-control-solid w-lg-250px w-md-250 w-200 ps-12"
                            placeholder="Cari..." />
                    </div>
                    <div id="table-export" class="d-none"></div>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPortofolio">
                    <i class="ki-duotone ki-plus fs-2"></i> Tambah Data
                </button>
            </div>
            <div class="card-body pt-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5"
                        id="table">
                        <thead class="fw-bold fs-7 text-uppercase text-gray-900 text-nowrap bg-gray-100">
                            <tr>
                                <th class="text-center px-3">No.</th>
                                <th class="pe-3 min-w-80px">Gambar</th>
                                <th class="pe-3 min-w-150px">Nama</th>
                                <th class="pe-3 min-w-150px ">Klien</th>
                                <th class="pe-3 min-w-150px ">Tanggal</th>
                                <th class="pe-3 min-w-150px">Lokasi</th>
                                <th class="pe-3 min-w-400px">Deskripsi</th>
                                <th class="pe-3 min-w-400px">Detail</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($portofolioList as $index => $portofolio)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center">
                                        <a class="d-block overlay me-3" data-fslightbox="lightbox-basic" href="{{ asset($portofolio->gambar) }}">
                                            <div class="symbol symbol-50px">
                                                <img src="{{ asset($portofolio->gambar) }}" alt="Gambar Produk" class="img-fluid" style="max-width: 50px;">
                                            </div>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                <i class="bi bi-eye-fill text-white"></i>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $portofolio->nama }}</td>
                                <td>{{ $portofolio->klien }}</td>
                                <td>{{ $portofolio->tanggalProyek }}</td>
                                <td>{{ $portofolio->lokasi }}</td>
                                <td>{{ Str::limit($portofolio->deskripsi, 100) }}</td>
                                <td>{{ $portofolio->detail ?? '-' }}</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn btn-outline btn-outline-primary btn-active-light-primary btn-sm btn-edit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" data-bs-target="#editPortofolioModal" data-bs-toggle="modal">
                                        <i class="ki-duotone ki-pencil fs-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn btn-outline btn-outline-danger btn-active-light-danger btn-sm"
                                        data-kt-permissions-table-filter="delete_row"
                                        data-id="{{ $portofolio->id }}"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        title="Hapus">
                                        <i class="ki-duotone ki-trash fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!--end::Table-->
            </div>
        </div>
    </div>
</div>
<!--end content-->

<!-- modal tambah -->
<div class="modal fade" id="modalTambahPortofolio" tabindex="-1" aria-labelledby="modalTambahPortofolioLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTambahPortofolioLabel">Tambah Produk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('portofolio.store') }}" id="formTambahPortofolio" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <!-- Upload Gambar -->
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" class="form-control dropify" name="gambar" id="gambar" accept="image/*" required>
                    </div>

                    <!-- Nama Portofolio -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Portofolio" required>
                    </div>

                    <!-- Nama klien -->
                    <div class="mb-3">
                        <label for="klien" class="form-label">Klien</label>
                        <input type="text" class="form-control" name="klien" id="klien" placeholder="Masukkan Klien Portofolio" required>
                    </div>

                    <!-- Nama tanggal proyek -->
                    <div class="mb-3">
                        <label for="tanggalProyek" class="form-label">Tanggal Proyek</label>
                        <input type="date" class="form-control" name="tanggalProyek" id="tanggalProyek" placeholder="Masukkan Nama Portofolio" required>
                    </div>

                    <!-- Nama lokasi -->
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Masukkan Lokasi Portofolio" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Masukkan Deskripsi Produk"></textarea>
                    </div>

                    <!-- Spesifikasi -->
                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail</label>
                        <div id="detail-container">
                            <div class="d-flex mb-2 detail-group">
                                <input type="text" class="form-control me-2" name="detail_key[]" placeholder="Detail (contoh: Perbaikan hardware dan software)">
                                <button type="button" class="btn btn-danger remove-detail">X</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success mt-2" id="addDetail">+ Tambah Detail</button>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" form="formTambahPortofolio">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editPortofolioModal" tabindex="-1" aria-labelledby="editPortofolioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editPortofolioModalLabel">Edit Produk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input untuk Edit Produk -->
                @if (isset($portofolio) && $portofolio !== null)
                <form action="{{ route('portofolio.update', ['id' => $portofolio->id ?? '']) }}" method="POST" id="editPortofolioForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control dropify" name="gambar" id="gambar">

                        @if ($portofolio->gambar)
                        <div class="mt-2">
                            <strong>Gambar Saat Ini:</strong>
                            <img src="{{ asset('storage/' . $portofolio->gambar) }}" alt="Current Image" class="img-fluid" style="max-width: 200px;">
                        </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $portofolio->nama) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="klien" class="form-label">Klien</label>
                        <input type="text" class="form-control" name="klien" id="klien" value="{{ old('klien', $portofolio->klien) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggalProyek" class="form-label">Tanggal Proyek</label>
                        <input type="text" class="form-control" name="tanggalProyek" id="tanggalProyek" value="{{ old('tanggalProyek', $portofolio->tanggalProyek) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" id="lokasi" value="{{ old('lokasi', $portofolio->lokasi) }}" required>
                    </div>


                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required>{{ old('deskripsi', $portofolio->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="detail" class="form-label">Detail Pekerjaan</label>
                        <div id="detail-container2">
                            @php
                            $details = old('detail', json_decode($portofolio->detail, true) ?? []);
                            @endphp

                            @if (!empty($details))
                            @foreach ($details as $detail)
                            <div class="d-flex mb-2">
                                <input type="text" class="form-control me-2" name="detail_key[]" value="{{ $detail }}" placeholder="Detail (contoh: Perbaikan hardware dan software)">
                                <button type="button" class="btn btn-danger remove-detail">X</button>
                            </div>
                            @endforeach
                            @else
                            <div class="d-flex mb-2">
                                <input type="text" class="form-control me-2" name="detail_key[]" placeholder="Detail (contoh: Perbaikan hardware dan software)">
                                <button type="button" class="btn btn-danger remove-detail">X</button>
                            </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-success" id="editDetail">+ Tambah Detail</button>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
                @else
                <p>No product data available to edit.</p>
                @endif

            </div>
        </div>
    </div>
</div>

@stack('js')

<!--js alert tambah data-->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("addDetail").addEventListener("click", function() {
            let specContainer = document.getElementById("detail-container");
            let newSpec = document.createElement("div");
            newSpec.classList.add("d-flex", "mb-2");
            newSpec.innerHTML = `
            <input type="text" class="form-control me-2" name="detail_key[]" placeholder="Detail (contoh: Perbaikan hardware dan software)">
            <button type="button" class="btn btn-danger remove-detail">X</button>
        `;
            specContainer.appendChild(newSpec);
        });

        document.getElementById("spesifikasi-container").addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-detail")) {
                e.target.parentElement.remove();
            }
        });
    });
</script>

<script>
    document.getElementById("formTambahPortofolio").addEventListener("submit", function(event) {
        event.preventDefault();

        let form = document.getElementById("formTambahPortofolio");
        let formData = new FormData(form);

        fetch("{{ route('portofolio.store') }}", {
                method: "POST",
                headers: {
                    "X-Requested-With": "XMLHttpRequest" // Penting untuk memberitahu Laravel bahwa ini adalah AJAX request
                },
                body: formData
            })
            .then(response => response.json().then(data => ({
                status: response.status,
                body: data
            }))) // Ambil status kode
            .then(result => {
                if (result.status === 200) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: result.body.message,
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        },
                        buttonsStyling: false
                    }).then(() => {
                        form.reset();

                        let modalElement = document.getElementById("modalTambahPortofolio");
                        let modalInstance = bootstrap.Modal.getInstance(modalElement);
                        modalInstance.hide();

                        location.reload(); // Reload untuk memperbarui tabel
                    });
                } else if (result.status === 422) {
                    let errors = Object.values(result.body.errors).map(err => err.join("\n")).join("\n");
                    Swal.fire("Validasi Gagal!", errors, "warning");
                } else {
                    Swal.fire("Gagal!", result.body.message || "Terjadi kesalahan pada server.", "error");
                }
            })
            .catch(error => {
                console.error("Fetch error:", error);
                Swal.fire("Error!", "Terjadi kesalahan pada server.", "error");
            });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("editDetail").addEventListener("click", function() {
            let detailContainer = document.getElementById("detail-container2");
            let newDetail = document.createElement("div");
            newDetail.classList.add("d-flex", "mb-2");
            newDetail.innerHTML = `
            <input type="text" class="form-control me-2" name="detail_key[]" placeholder="Detail (contoh: Perbaikan hardware dan software)">
                <button type="button" class="btn btn-danger remove-detail">X</button>
                `;
            detailContainer.appendChild(newDetail);
        });

        // Perbaikan di sini (pastikan elemen yang ditambahkan bisa dihapus)
        document.getElementById("detail-container2").addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-detail")) {
                e.target.parentElement.remove();
            }
        });
    });
</script>


<script>
    document.querySelectorAll('.btn-edit').forEach(function(button) {
        button.addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('editPortofolioModal'));
            modal.show();
        });
    });

    document.getElementById('editPortofolioForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        Swal.fire({
            title: 'Apakah Anda yakin ingin menyimpan perubahan?',
            text: "Perubahan tidak bisa dibatalkan setelah disimpan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, simpan!',
            cancelButtonText: 'Tidak, batalkan',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-dark'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sedang menyimpan...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Collect form data
                var form = document.getElementById('editPortofolioForm');
                var formData = new FormData(form);

                // Log form data for debugging
                console.log('Form data:', formData);

                fetch(form.action, { // Make sure to use the correct URL for your update route
                        method: 'POST', // Use POST or PUT depending on your backend configuration
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Response from server:', data); // Log the response to inspect

                        if (data.success) {
                            // Close the modal if update is successful
                            const modal = bootstrap.Modal.getInstance(document.getElementById('editPortofolioModal'));
                            modal.hide();

                            // Show success message
                            Swal.fire(
                                'Berhasil!',
                                'Perubahan telah disimpan.',
                                'success'
                            ).then(() => {
                                location.reload(); // Optionally refresh the page to reflect changes
                            });
                        } else {
                            // If there’s an error, show an error message
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menyimpan perubahan.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        console.error('AJAX error:', error); // Log AJAX errors
                        Swal.fire(
                            'Gagal!',
                            'Terjadi kesalahan saat menyimpan perubahan.',
                            'error'
                        );
                    });
            } else {
                // If user cancels the operation
                Swal.fire(
                    'Dibatalkan',
                    'Perubahan tidak disimpan.',
                    'error'
                ).then(() => {
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editPortofolioModal'));
                    modal.hide();
                });
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('[data-kt-permissions-table-filter="delete_row"]').forEach(button => {
            button.addEventListener("click", function() {
                // Ambil ID produk dari data-id
                let portofolioId = button.getAttribute("data-id");

                // Menampilkan SweetAlert untuk konfirmasi
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Batal",
                    reverseButtons: true,
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-dark"
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim request AJAX untuk menghapus data dan gambar
                        $.ajax({
                            url: '/dashboard/portofolio/' + portofolioId, // Gantilah dengan route yang benar
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Tambahkan header CSRF token
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Menghapus baris dari tabel
                                    let row = button.closest("tr");
                                    row.remove();

                                    // Menampilkan SweetAlert untuk sukses
                                    Swal.fire({
                                        title: "Dihapus!",
                                        text: "Data berhasil dihapus.",
                                        icon: "success",
                                        confirmButtonText: "OK",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        },
                                        buttonsStyling: false
                                    });
                                } else {
                                    // Menampilkan error jika gagal
                                    Swal.fire({
                                        title: "Gagal!",
                                        text: response.message,
                                        icon: "error",
                                        confirmButtonText: "OK",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        },
                                        buttonsStyling: false
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                // Error handling
                                Swal.fire({
                                    title: "Terjadi kesalahan!",
                                    text: "Tidak dapat menghapus data.",
                                    icon: "error",
                                    confirmButtonText: "OK",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    },
                                    buttonsStyling: false
                                });
                            }
                        });
                    }
                });
            });
        });
    });
</script>

@endstack


@endsection