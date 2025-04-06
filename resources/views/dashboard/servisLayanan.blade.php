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
                                <th class="text-center pe-3 min-w-80px">ID</th>
                                <th class="pe-3 min-w-150px">Nama</th>
                                <th class="pe-3 min-w-150px">Alamat</th>
                                <th class="pe-3 min-w-150px">Telepon</th>
                                <th class="pe-3 min-w-150px">Jenis Layanan</th>
                                <th class="pe-3 min-w-150px">Tanggal</th>
                                <th class="pe-3 min-w-150px">Petugas</th>
                                <th class="pe-3 min-w-150px">Harga</th>
                                <th class="pe-3 min-w-150px">Status</th>
                                <th class="pe-3 min-w-150px">Proses</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($servisJasa as $jasa)
                            <tr>
                                <td class="text-center">{{ $jasa->order_id }}</td>
                                <td>{{ $jasa->user->nama ?? 'Tidak Tersedia' }}</td>
                                <td>{{ $jasa->alamat }}</td>
                                <td>{{ $jasa->telepon }}</td>
                                <td>{{ $jasa->jenisJasa?->nama ?? 'Tidak Tersedia' }}</td>
                                <td>{{ \Carbon\Carbon::parse($jasa->tanggal)->format('d M Y') }}</td>
                                <td>
                                    {{ $jasa->servisLayananPetugas->petugas->nama ?? 'Belum Ditugaskan' }}
                                </td>
                                <td>Rp. {{ number_format($jasa->harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-{{ $jasa->status == 'paid' ? 'success' : ($jasa->status == 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($jasa->status) }}
                                    </span>
                                </td>
                                <td>{{ $jasa->proses }}</td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn-outline btn-outline-primary btn-sm btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editStatusModal"
                                        data-id="{{ $jasa->id }}"
                                        data-status="{{ $jasa->status }}">
                                        <i class="fas fa-pen fs-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn-outline btn-outline-success btn-sm btn-pilih-petugas"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalPenugasan"
                                        data-id="{{ $jasa->id }}">
                                        <i class="fas fa-user-check fs-2"></i>
                                    </button>
                                    <!-- Tombol Edit Tanggal -->
                                    <button class="btn btn-icon btn-outline btn-outline-warning btn-sm btn-edit-tanggal"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editTanggalModal"
                                        data-id="{{ $jasa->id }}"
                                        data-tanggal="{{ $jasa->tanggal }}">
                                        <i class="fas fa-clock fs-2"></i>
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
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusLabel">Edit Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStatusForm">
                    @csrf
                    <input type="hidden" id="servisJasaId" name="id">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="canceled">Canceled</option>
                        </select>
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Penugasan Petugas -->
<div class="modal fade" id="modalPenugasan" tabindex="-1" aria-labelledby="modalPenugasanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPenugasanLabel">Tugaskan Petugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formPenugasan" method="POST" action="{{ route('orderServisLayanan.petugas') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="servis_layanan_id" name="servis_layanan_id">

                    <label for="petugas_id">Pilih Petugas</label>
                    <select class="form-control" id="petugas_id" name="petugas_id">
                        @foreach ($petugas as $p)
                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tugaskan Petugas</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editTanggalModal" tabindex="-1" aria-labelledby="editTanggalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTanggalModalLabel">Edit Jadwal Servis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editTanggalForm">
                    @csrf
                    <input type="hidden" name="servis_jasa_id" id="servisJasaId">
                    <div class="mb-3">
                        <label for="editTanggal" class="form-label">Tanggal Servis</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                const servisJasaId = this.getAttribute('data-id');
                const servisStatus = this.getAttribute('data-status');

                console.log('Servis ID:', servisJasaId); // Debugging
                console.log('Status:', servisStatus); // Debugging

                if (!servisJasaId) {
                    Swal.fire('Gagal!', 'ID tidak ditemukan!', 'error');
                    return;
                }

                document.getElementById('servisJasaId').value = servisJasaId;
                document.getElementById('status').value = servisStatus;
            });
        });

    });

    // Mengirim form update status melalui AJAX
    document.getElementById('editStatusForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const servisJasaId = document.getElementById('servisJasaId').value;
        const status = document.getElementById('status').value;

        fetch(`/dashboard/servis-layanan/${servisJasaId}`, {
                method: 'POST', // Laravel membutuhkan POST jika tanpa FormData
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    _method: 'PUT', // Laravel membutuhkan ini untuk mengenali metode PUT
                    status: status
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Ketika tombol "Pilih Petugas" ditekan
        document.querySelectorAll(".btn-pilih-petugas").forEach(button => {
            button.addEventListener("click", function() {
                let servisId = this.getAttribute("data-id"); // Ambil ID servis
                document.getElementById("servis_layanan_id").value = servisId; // Set ID servis ke input hidden
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menangani klik tombol edit tanggal
        document.querySelectorAll('.btn-edit-tanggal').forEach(button => {
            button.addEventListener('click', function() {
                let servisJasaId = this.getAttribute('data-id'); // Ambil ID dari button
                let tanggal = this.getAttribute('data-tanggal'); // Ambil tanggal dari button

                console.log('Servis ID:', servisJasaId); // Debugging
                console.log('Tanggal:', tanggal); // Debugging

                if (!servisJasaId) {
                    Swal.fire('Gagal!', 'ID tidak ditemukan!', 'error');
                    return;
                }

                document.getElementById('servisJasaId').value = servisJasaId;
                document.getElementById('tanggal').value = tanggal; // Perbaikan dari 'status' ke 'tanggal'
            });
        });

        // Menangani submit form
        document.getElementById('editTanggalForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const servisJasaId = document.getElementById('servisJasaId').value;
            const tanggal = document.getElementById('tanggal').value;

            fetch(`/dashboard/servis-layanan/update-tanggal/${servisJasaId}`, {
                    method: 'POST', // Gunakan POST agar Laravel menerima FormData
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        _method: 'PUT', // Tambahkan agar dikenali sebagai PUT
                        servis_jasa_id: servisJasaId, // Pastikan ini dikirim
                        tanggal: tanggal
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire('Berhasil!', data.message, 'success');
                        window.location.reload();
                    } else {
                        console.log(data.errors); // Debugging
                        Swal.fire('Gagal!', 'Validasi gagal: ' + JSON.stringify(data.errors), 'error');
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