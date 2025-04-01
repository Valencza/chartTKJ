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
                                <th class="pe-3 min-w-150px">Jenis Layanan</th>
                                <th class="pe-3 min-w-150px">Deskripsi</th>
                                <th class="pe-3 min-w-150px">Tanggal</th>
                                <th class="pe-3 min-w-150px">proses</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($servisLayananPetugas as $servis)
                            <tr>
                                <td class="text-center">{{ $servis->order_id }}</td>
                                <td>{{ $servis->user->nama ?? 'Nama Tidak Tersedia' }}</td>
                                <td>{{ $servis->jenisJasa?->nama ?? 'Layanan Tidak Tersedia' }}</td>
                                <td>
                                    {{ $servis->deskripsi ?? 'Tidak Ada Deskripsi' }}
                                </td>
                                <td>{{ $servis->tanggal ? \Carbon\Carbon::parse($servis->tanggal)->format('d-m-Y') : 'Belum Ada Tanggal' }}</td>
                                <td>
                                    {{ $servis->proses ?? 'Menunggu' }}
                                </td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn-outline btn-outline-primary btn-sm btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editStatusModal"
                                        data-id="{{ $servis->id }}"
                                        data-proses="{{ $servis->proses }}"
                                        {{ $servis->proses === 'selesai' ? 'disabled' : '' }}>
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

<!-- Modal untuk Edit Status -->
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusModalLabel">Edit Status Servis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStatusForm">
                    @csrf
                    <input type="hidden" id="servisLayananId" name="servis_layanan_id">
                    <div class="mb-3">
                        <label for="proses" class="form-label">Proses</label>
                        <select class="form-select" id="proses" name="proses" required>
                            <option value="dalam perjalanan">Dalam Perjalanan</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const servisLayananId = this.getAttribute('data-id');
                const servisProses = this.getAttribute('data-proses');

                console.log('Servis ID:', servisLayananId); // Debugging
                console.log('Proses:', servisProses); // Debugging

                // Mengatur nilai pada modal
                document.getElementById('servisLayananId').value = servisLayananId;
                document.getElementById('status').value = servisProses;
            });
        });
    });

    // Mengirim form update status melalui AJAX
    document.getElementById('editStatusForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const servisLayananId = document.getElementById('servisLayananId').value;
        const proses = document.getElementById('proses').value;

        fetch(`/order-servis-layanan-petugas/${servisLayananId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    proses: proses
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