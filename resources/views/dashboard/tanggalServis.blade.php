@extends('dashboard.layouts.app')

@section('content')

<!--start content-->
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="card card-flush">
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"></i>
                        <input type="text" table-search="search" class="form-control form-control-solid w-lg-250px w-md-250 w-200 ps-12" placeholder="Cari..." />
                    </div>
                    <div id="table-export" class="d-none"></div>
                </div>
            </div>
            <div class="card-body pt-0">
                <!--begin::Table-->
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                        <thead class="fw-bold fs-7 text-uppercase text-gray-900 text-nowrap bg-gray-100">
                            <tr>
                                <th class="text-center pe-3 min-w-80px">Order Id</th>
                                <th class="pe-3 min-w-150px">Nama</th>
                                <th class="pe-3 min-w-150px">Petugas</th>
                                <th class="pe-3 min-w-150px">Jenis Barang</th>
                                <th class="pe-3 min-w-150px">Merk</th>
                                <th class="pe-3 min-w-150px">Jenis Kerusakan</th>
                                <th class="pe-3 min-w-150px">Back Up</th>
                                <th class="pe-3 min-w-150px">Password</th>
                                <th class="pe-3 min-w-150px">Tanggal Diterima</th>
                                <th class="pe-3 min-w-150px">Tanggal Diserahkan</th>
                                <th class="pe-3 min-w-150px">Proses</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($informasiTanggal as $tanggal)
                            <tr>
                                <td class="text-center">{{ $tanggal->servisBarang->order_id }}</td>
                                <td>{{ $tanggal->servisBarang->user->nama ?? 'Nama Tidak Tersedia' }}</td>
                                <td>{{ $tanggal->servisBarang->petugas->nama ?? 'Belum Ditugaskan' }}</td>
                                <td>{{ $tanggal->servisBarang->jenisBarang?->nama ?? 'Barang Tidak Tersedia' }}</td>
                                <td class="text-center">{{ $tanggal->servisBarang->merk ?? 'Tidak Ada Merk' }}</td>
                                <td>{{ $tanggal->servisBarang->jenisKerusakan?->nama ?? 'Barang Tidak Tersedia' }}</td>
                                <td class="text-center">{{ $tanggal->servisBarang->backUp ?? 'Tidak ada Data'}}</td>
                                <td class="text-center">{{ $tanggal->servisBarang->password ?? 'Tidak Ada Password' }}</td>
                                <td>{{ $tanggal->tanggal_diterima ? \Carbon\Carbon::parse($tanggal->tanggal_diterima)->format('d-m-Y') : 'Belum Diterima' }}</td>
                                <td>{{ $tanggal->tanggal_diserahkan ? \Carbon\Carbon::parse($tanggal->tanggal_diserahkan)->format('d-m-Y') : 'Belum Diserahkan' }}</td>
                                <td>{{ $tanggal->servisBarang->proses ?? 'Belum Selesai' }}</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn-outline btn-outline-primary btn-sm btn-diterima"
                                        data-bs-toggle="modal"
                                        data-bs-target="#tanggalDiterimaModal"
                                        data-id="{{ $tanggal->servis_barang_id }}"
                                        data-tanggal="{{ $tanggal->tanggal_diterima }}">
                                        <i class="ki-duotone ki-pencil fs-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn-outline btn-outline-success btn-sm btn-diserahkan"
                                        data-bs-toggle="modal"
                                        data-bs-target="#tanggalDiserahkanModal"
                                        data-id="{{ $tanggal->servis_barang_id }}"
                                        data-tanggal="{{ $tanggal->tanggal_diserahkan }}">
                                        <i class="ki-duotone ki-pencil fs-2"></i>
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

<!-- Modal untuk tanggal diterima -->
<div class="modal fade" id="tanggalDiterimaModal" tabindex="-1" aria-labelledby="tanggalDiterimaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tanggalDiterimaModalLabel">Edit Tanggal Diterima</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tanggalDiterimaForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="servisBarangId" name="servis_barang_id">
                    <div class="mb-3">
                        <label for="tanggal_diterima" class="form-label fw-bold">Tanggal Diterima :</label>
                        <input type="date" class="form-control" id="tanggal_diterima" name="tanggal_diterima" required>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal tanggal diserahkan -->
<div class="modal fade" id="tanggalDiserahkanModal" tabindex="-1" aria-labelledby="tanggalDiserahkanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tanggalDiserahkanModalLabel">Edit Tanggal Diserahkan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="tanggalDiserahkanForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="servis_barang_id" name="servis_barang_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tanggal_diserahkan" class="form-label fw-bold">Tanggal Diserahkan :</label>
                        <input type="date" class="form-control" id="tanggal_diserahkan" name="tanggal_diserahkan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('tanggalDiterimaModal');
        const tanggalDiterimaForm = document.getElementById('tanggalDiterimaForm');
        let modalInstance = new bootstrap.Modal(modalElement);

        // Event delegation untuk tombol edit
        document.body.addEventListener('click', function(event) {
            if (event.target.closest('.btn-diterima')) {
                const button = event.target.closest('.btn-diterima');
                const servisBarangId = button.getAttribute('data-id');
                let tanggalDiterima = button.getAttribute('data-tanggal');

                console.log("Tanggal sebelum diproses:", tanggalDiterima); // Debugging

                // Jika data ada, pastikan formatnya sesuai (YYYY-MM-DD)
                if (tanggalDiterima) {
                    let dateObj = new Date(tanggalDiterima);
                    let formattedDate = dateObj.toISOString().split('T')[0]; // Konversi ke YYYY-MM-DD
                    tanggalDiterima = formattedDate;
                }

                console.log("Tanggal setelah diproses:", tanggalDiterima); // Debugging

                document.getElementById('servisBarangId').value = servisBarangId;
                document.getElementById('tanggal_diterima').value = tanggalDiterima || ''; // Set nilai jika ada

                // Tampilkan modal setelah data diisi
                modalInstance.show();
            }
        });

        // Mengirim form update status melalui AJAX
        tanggalDiterimaForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const servisBarangId = document.getElementById('servisBarangId').value;
            const tanggalDiterima = document.getElementById('tanggal_diterima').value;

            if (!tanggalDiterima) {
                Swal.fire('Peringatan!', 'Tanggal diterima harus diisi.', 'warning');
                return;
            }

            fetch(`/dashboard/informasi-tanggal/terima/${servisBarangId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        _method: 'PUT',
                        tanggal_diterima: tanggalDiterima
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Berhasil!', data.message, 'success');
                        modalInstance.hide();
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        Swal.fire('Gagal!', data.message || 'Terjadi kesalahan.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan perubahan.', 'error');
                });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modalElement = document.getElementById('tanggalDiserahkanModal');
        const tanggalDiserahkanForm = document.getElementById('tanggalDiserahkanForm');
        let modalInstance = new bootstrap.Modal(modalElement);

        // Event delegation untuk tombol edit
        document.body.addEventListener('click', function(event) {
            if (event.target.closest('.btn-diserahkan')) {
                const button = event.target.closest('.btn-diserahkan');
                const servisBarangId = button.getAttribute('data-id');
                let tanggalDiserahkan = button.getAttribute('data-tanggal');

                console.log("Tanggal sebelum diproses:", tanggalDiserahkan); // Debugging

                // Jika data ada, pastikan formatnya sesuai (YYYY-MM-DD)
                if (tanggalDiserahkan) {
                    let dateObj = new Date(tanggalDiserahkan);
                    let formattedDate = dateObj.toISOString().split('T')[0]; // Konversi ke YYYY-MM-DD
                    tanggalDiserahkan = formattedDate;
                }

                console.log("Tanggal setelah diproses:", tanggalDiserahkan); // Debugging

                document.getElementById('servisBarangId').value = servisBarangId;
                document.getElementById('tanggal_diserahkan').value = tanggalDiserahkan || ''; // Set nilai jika ada

                // Tampilkan modal setelah data diisi
                modalInstance.show();
            }
        });

        // Mengirim form update status melalui AJAX
        tanggalDiserahkanForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const servisBarangId = document.getElementById('servisBarangId').value;
            const tanggalDiserahkan = document.getElementById('tanggal_diserahkan').value;

            if (!tanggalDiserahkan) {
                Swal.fire('Peringatan!', 'Tanggal diserahkan harus diisi.', 'warning');
                return;
            }

            fetch(`/dashboard/informasi-tanggal/serahkan/${servisBarangId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        _method: 'PUT',
                        tanggal_diserahkan: tanggalDiserahkan
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Berhasil!', data.message, 'success');
                        modalInstance.hide();
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        Swal.fire('Gagal!', data.message || 'Terjadi kesalahan.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menyimpan perubahan.', 'error');
                });
        });
    });
</script>

@endsection