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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
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
                                <th class="pe-3 min-w-150px">Nama Produk</th>
                                <th class="pe-3 min-w-150px">Kategori</th>
                                <th class="pe-3 min-w-150px ">Harga</th>
                                <th class="pe-3 min-w-400px">Deskripsi</th>
                                <th class="pe-3 min-w-400px">Spesifikasi</th>
                                <th class="pe-3 min-w-60px text-center">Terjual</th>
                                <th class="pe-3 min-w-60px text-center">Stok</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($produkList as $index => $produk)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center">
                                        <a class="d-block overlay me-3" data-fslightbox="lightbox-basic" href="{{ asset('storage/' . $produk->gambar) }}">
                                            <div class="symbol symbol-50px">
                                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Gambar Produk" class="img-fluid" style="max-width: 50px;">
                                            </div>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                <i class="bi bi-eye-fill text-white"></i>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $produk->nama }}</td>
                                <td>{{ $produk->kategori->nama ?? 'Tidak Ada Kategori' }}</td>
                                <td>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                <td>{{ $produk->deskripsi }}</td>
                                <td>{{ $produk->spesifikasi }}</td>
                                <td class="text-center">{{ $produk->stok_out }}</td>
                                <td class="text-center">
                                    <div class="badge badge-light-success fs-5">{{ $produk->stok_in }}</div>
                                </td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn btn-outline btn-outline-primary btn-active-light-primary btn-sm btn-edit" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" data-bs-target="#editProductModal" data-bs-toggle="modal">
                                        <i class="ki-duotone ki-pencil fs-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn btn-outline btn-outline-danger btn-active-light-danger btn-sm"
                                        data-kt-permissions-table-filter="delete_row"
                                        data-id="{{ $produk->id }}"
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
<div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalTambahProdukLabel">Tambah Produk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route ('produk.store') }}" id="formTambahProduk" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Upload Gambar -->
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control dropify" name="gambar" id="gambar" accept="image/*" required>
                    </div>

                    <!-- Nama Produk -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Produk" required>
                    </div>

                    <!-- Dropdown Kategori -->
                    <select class="form-select" name="id_kategoriProduk" id="kategoriProdukList" required>
                        <option value="" selected disabled>Pilih Kategori</option>
                        @foreach($kategoriProdukList as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>

                    <!-- Harga -->
                    <div class="mb-3">
                        <label class="form-label" for="harga">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control ps-2 count" name="harga" id="harga" placeholder="0" min="0" required>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder="Masukkan Deskripsi Produk"></textarea>
                    </div>

                    <!-- Spesifikasi -->
                    <div class="mb-3">
                        <label for="spesifikasi" class="form-label">Spesifikasi</label>
                        <textarea class="form-control" name="spesifikasi" id="spesifikasi" rows="3" placeholder="Masukkan Spesifikasi Produk (opsional)"></textarea>
                    </div>

                    <!-- Terjual -->
                    <div class="mb-3">
                        <label for="stok_out" class="form-label">Terjual</label>
                        <input type="number" class="form-control" name="stok_out" id="stok_out" placeholder="Jumlah Terjual" required>
                    </div>

                    <!-- Stok -->
                    <div class="mb-3">
                        <label for="stok_in" class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok_in" id="stok_in" placeholder="Jumlah Stok" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" form="formTambahProduk">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editProductModalLabel">Edit Produk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input untuk Edit Produk -->
                @if (isset($produk) && $produk !== null)
                <form action="{{ route('produk.update', ['id' => $produk->id ?? '']) }}" method="POST" id="editProductForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Produk</label>
                        <input type="file" class="form-control dropify" name="gambar" id="gambar">

                        @if ($produk->gambar)
                        <div class="mt-2">
                            <strong>Gambar Saat Ini:</strong>
                            <img src="{{ asset('storage/' . $produk->gambar) }}" alt="Current Image" class="img-fluid" style="max-width: 200px;">
                        </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $produk->nama) }}" required>
                    </div>

                    <!-- Dropdown Kategori -->
                    <div class="mb-3">
                        <label for="id_kategoriProduk" class="form-label">Kategori Produk</label>
                        <select name="id_kategoriProduk" id="id_kategoriProduk" class="form-control" required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategoriProdukList as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('id_kategoriProduk', $produk->id_kategoriProduk) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga" id="harga" value="{{ old('harga', $produk->harga) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="spesifikasi" class="form-label">Spesifikasi</label>
                        <textarea class="form-control" name="spesifikasi" id="spesifikasi" rows="3" required>{{ old('spesifikasi', $produk->spesifikasi) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="stok_out" class="form-label">Terjual</label>
                        <input type="number" class="form-control" name="stok_out" id="stok_out" value="{{ old('stok_out', $produk->stok_out) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="stok_in" class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok_in" id="stok_in" value="{{ old('stok_in', $produk->stok_in) }}" required>
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


<!--js alert tambah data-->
<script>
    document.getElementById("formTambahProduk").addEventListener("submit", function(event) {
        event.preventDefault();

        let form = document.getElementById("formTambahProduk");
        let formData = new FormData(form);

        fetch("{{ route('produk.store') }}", {
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

                        let modalElement = document.getElementById("modalTambahProduk");
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
            const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
            modal.show();
        });
    });

    document.getElementById('editProductForm').addEventListener('submit', function(event) {
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
                var form = document.getElementById('editProductForm');
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
                            const modal = bootstrap.Modal.getInstance(document.getElementById('editProductModal'));
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
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editProductModal'));
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
                let produkId = button.getAttribute("data-id");

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
                            url: '/dashboard/produk/' + produkId, // Gantilah dengan route yang benar
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