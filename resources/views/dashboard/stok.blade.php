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
                                <th class="pe-3 min-w-80px">Gambar</th>
                                <th class="pe-3 min-w-80px">Nama</th>
                                <th class="pe-3 min-w-150px">Kategori</th>
                                <th class="pe-3 min-w-150px">Tersisa</th>
                                <th class="pe-3 min-w-150px">Terjual</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($produkList as $index => $produk)
                            <tr>
                                <!-- Menggunakan nomor urut -->
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center">
                                        <a class="d-block overlay me-3" data-fslightbox="lightbox-basic" href="{{ asset($produk->gambar) }}">
                                            <div class="symbol symbol-50px">
                                                <img src="{{ asset($produk->gambar) }}" alt="Gambar Produk" class="img-fluid" style="max-width: 50px;">
                                            </div>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                <i class="bi bi-eye-fill text-white"></i>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td>{{ $produk->nama ?? '-' }}</td>
                                <td>{{ $produk->kategori->nama ?? '-' }}</td>
                                <td>{{ $produk->stok_in ?? '-' }}</td>
                                <td>{{ $produk->stok_out ?? '-' }}</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn-outline btn-outline-primary btn-sm btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editStokModal"
                                        data-id="{{ $produk->id }}"
                                        data-stok="{{ $produk->stok_in }}">
                                        <i class="fas fa-pen fs-2"></i>
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

<!-- Modal untuk Edit Status -->
<div class="modal fade" id="editStokModal" tabindex="-1" aria-labelledby="editStokModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStokModalLabel">Edit Stok Tersisa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStokForm">
                    @csrf
                    <input type="hidden" id="produkId" name="produkId">
                    <div class="mb-3">
                        <label for="stok_in" class="form-label">Tersisa</label>
                        <input type="number" class="form-control" name="stok_in" id="stok_in" value="{{ old('stok_in', $produk->stok_in) }}" required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const produkId = this.getAttribute('data-id');
                const stok_in = this.getAttribute('data-stok');

                console.log('User ID:', produkId); // Debugging
                console.log('Stok:', stok_in); // Debugging

                // Mengatur nilai pada modal
                document.getElementById('produkId').value = produkId;
                document.getElementById('stok_in').value = stok_in;
            });
        });
    });

    // Mengirim form update status melalui AJAX
    document.getElementById('editStokForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const produkId = document.getElementById('produkId').value;
        const stok_in = document.getElementById('stok_in').value;

        fetch(`/dashboard/stok-produk/${produkId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    stok_in: stok_in
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil!', data.message, 'success');
                    window.location.reload();
                } else {
                    Swal.fire('Gagal!', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan perubahan.', 'error');
            });
    });
</script>

@endsection