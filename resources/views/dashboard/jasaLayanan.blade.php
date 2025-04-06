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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
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
                                <th class="pe-3 min-w-150px">Nama</th>
                                <th class="pe-3 min-w-150px">Harga</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($jenisLayananList as $index => $jenisLayanan)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $jenisLayanan->nama }}</td>
                                <td>Rp. {{ number_format($jenisLayanan->harga, 0, ',', '.') }}</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn btn-outline btn-outline-primary btn-active-light-primary btn-sm btn-edit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" data-bs-target="#editKategoriModal" data-bs-toggle="modal">
                                        <i class="fas fa-pen fs-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn btn-outline btn-outline-danger btn-active-light-danger btn-sm"
                                        data-kt-permissions-table-filter="delete_row"
                                        data-id="{{ $jenisLayanan->id }}"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        title="Hapus">
                                        <i class="fas fa-trash-alt fs-2"></i>
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
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTambahKategoriLabel">Tambah Jasa Layanan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route ('jenisLayanan.store') }}" id="formTambahKategori" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Kategori -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Jenis Layanan</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Kategori" required>
                    </div>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label class="form-label" for="harga">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control ps-2 count" name="harga" id="harga" placeholder="0" min="0" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" form="formTambahKategori">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editKategoriModalLabel">Edit Jasa Layanan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input untuk Edit Produk -->
                @if (isset($jenisLayanan) && $jenisLayanan !== null)
                <form action="{{ route('jenisLayanan.update', ['id' => $jenisLayanan->id ?? '']) }}" method="POST" id="editKategoriForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Jasa Layanan</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $jenisLayanan->nama) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" value="{{ old('harga', $jenisLayanan->harga) }}" required>
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
    document.getElementById("formTambahKategori").addEventListener("submit", function(event) {
        event.preventDefault();

        let form = document.getElementById("formTambahKategori");
        let formData = new FormData(form);

        fetch("{{ route('jenisLayanan.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Data berhasil ditambahkan.",
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        },
                        buttonsStyling: false
                    }).then(() => {
                        form.reset();

                        let modalElement = document.getElementById("modalTambahKategori");
                        let modalInstance = bootstrap.Modal.getInstance(modalElement);
                        modalInstance.hide();

                        // Reload data atau lakukan aksi tambahan
                        location.reload();
                    });
                } else {
                    Swal.fire("Gagal!", data.message, "error");
                }
            })
            .catch(error => {
                Swal.fire("Error!", "Terjadi kesalahan pada server.", "error");
            });
    });
</script>

<script>
    document.querySelectorAll('.btn-edit').forEach(function(button) {
        button.addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('editKategoriModal'));
            modal.show();
        });
    });

    document.getElementById('editKategoriForm').addEventListener('submit', function(event) {
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
                var form = document.getElementById('editKategoriForm');
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
                            const modal = bootstrap.Modal.getInstance(document.getElementById('editKategoriModal'));
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editKategoriModal'));
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
                let jenisLayananId = button.getAttribute("data-id");

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
                            url: '/dashboard/jenis-layanan/' + jenisLayananId, // Gantilah dengan route yang benar
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

@endsection