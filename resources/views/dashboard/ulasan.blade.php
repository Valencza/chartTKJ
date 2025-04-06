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
            </div>
            <div class="card-body pt-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5"
                        id="table">
                        <thead class="fw-bold fs-7 text-uppercase text-gray-900 text-nowrap bg-gray-100">
                            <tr>
                                <th class="text-center pe-3 min-w-80px">No</th>
                                <th class="pe-3 min-w-80px">Nama</th>
                                <th class="pe-3 min-w-150px">Produk</th>
                                <th class="pe-3 min-w-150px">rating</th>
                                <th class="pe-3 min-w-150px">deskripsi</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($ulasan as $index => $komen)
                            <tr>
                                <!-- Menggunakan nomor urut -->
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $komen->user->nama ?? '-' }}</td>
                                <td>{{ $komen->produk->nama ?? '-' }}</td>
                                <td>
                                    @for ($i = 1; $i <= ($komen->rating ?? 0); $i++)
                                        <i class="fas fa-star text-warning"></i>
                                        @endfor
                                </td>
                                <td>{{ $komen->deskripsi ?? '-' }}</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn btn-outline btn-outline-danger btn-active-light-danger btn-sm"
                                        data-kt-permissions-table-filter="delete_row"
                                        data-id="{{ $komen->id }}"
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('[data-kt-permissions-table-filter="delete_row"]').forEach(button => {
            button.addEventListener("click", function() {
                // Ambil ID produk dari data-id
                let ulasanId = button.getAttribute("data-id");

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
                            url: '/dashboard/ulasan-produk/' + ulasanId, // Gantilah dengan route yang benar
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