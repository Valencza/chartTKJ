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
                                <th class="pe-3 min-w-200px">Notifikasi</th>
                                <th class="pe-3 min-w-150px">Nama</th>
                                <th class="pe-3 min-w-150px">Alamat</th>
                                <th class="pe-3 min-w-150px">Telepon</th>
                                <th class="pe-3 min-w-150px">Jenis Layanan</th>
                                <th class="pe-3 min-w-150px">Tanggal</th>
                                <th class="pe-3 min-w-150px">Petugas</th>
                                <th class="pe-3 min-w-150px">Status</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($servisJasa as $jasa)
                            @if ($jasa->notifikasi->isNotEmpty())
                            @foreach ($jasa->notifikasi as $key => $notif)
                            <tr>
                                <td class="text-center">{{ $jasa->order_id }}</td>
                                <td>{{ $notif->pesan }}</td>
                                <td>{{ $jasa->user->nama ?? 'Tidak Tersedia' }}</td>
                                <td>{{ $jasa->alamat }}</td>
                                <td>{{ $jasa->telepon }}</td>
                                <td>{{ $jasa->jenisJasa?->nama ?? 'Tidak Tersedia' }}</td>
                                <td>{{ \Carbon\Carbon::parse($jasa->tanggal)->format('d M Y') }}</td>
                                <td>{{ $jasa->servisLayananPetugas->petugas->nama ?? 'Belum Ditugaskan' }}</td>
                                <td>{{ $notif->status }}</td>
                                <td class="text-end text-nowrap">
                                    <!-- Tombol Edit Tanggal -->
                                    <button class="btn btn-icon btn-outline btn-outline-warning btn-sm btn-edit-tanggal"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editTanggalModal"
                                        data-id="{{ $jasa->id }}"
                                        data-tanggal="{{ $jasa->tanggal }}"
                                        @if($notif->status === 'disetujui')
                                        disabled
                                        @endif
                                        >
                                        <i class="ki-duotone ki-calendar fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <!-- Jika tidak ada notifikasi, tampilkan satu baris biasa -->
                            <tr>
                                <td class="text-center">{{ $jasa->order_id }}</td>
                                <td>Tidak ada notifikasi</td>
                                <td>{{ $jasa->user->nama ?? 'Tidak Tersedia' }}</td>
                                <td>{{ $jasa->alamat }}</td>
                                <td>{{ $jasa->telepon }}</td>
                                <td>{{ $jasa->jenisJasa?->nama ?? 'Tidak Tersedia' }}</td>
                                <td>{{ \Carbon\Carbon::parse($jasa->tanggal)->format('d M Y') }}</td>
                                <td>{{ $jasa->servisLayananPetugas->petugas->nama ?? 'Belum Ditugaskan' }}</td>
                                <td>Negosiasi</td>
                                <td class="text-end text-nowrap">
                                    <!-- Tombol Edit Tanggal -->
                                    <button class="btn btn-icon btn-outline btn-outline-warning btn-sm btn-edit-tanggal"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editTanggalModal"
                                        data-id="{{ $jasa->id }}"
                                        data-tanggal="{{ $jasa->tanggal }}">
                                        <i class="ki-duotone ki-calendar fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                            @endif
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

            fetch(`/dashboard/notifikasi/servis-layanan/update-tanggal/${servisJasaId}`, {
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