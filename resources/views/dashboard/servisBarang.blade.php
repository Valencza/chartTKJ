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
                                <th class="pe-3 min-w-150px">Jenis Barang</th>
                                <th class="pe-3 min-w-150px">Jenis Kerusakan</th>
                                <th class="pe-3 min-w-150px">Tanggal Servis</th>
                                <th class="pe-3 min-w-150px">Harga</th>
                                <th class="pe-3 min-w-150px">Petugas</th>
                                <th class="pe-3 min-w-150px">Status</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($servisBarang as $servis)
                            <tr>
                                <td class="text-center">{{ $servis->order_id }}</td>
                                <td>{{ $servis->user->nama ?? 'Nama Tidak Tersedia' }}</td>
                                <td>{{ $servis->jenisBarang?->nama ?? 'Barang Tidak Tersedia' }}</td>
                                <td>{{ $servis->jenisKerusakan?->nama ?? 'Kerusakan Tidak Tersedia' }}</td>
                                <td>{{ \Carbon\Carbon::parse($servis->tanggal)->format('d M Y') }}</td>
                                <td>Rp. {{ number_format($servis->harga, 0, ',', '.') }}</td>
                                <td>
                                    {{ $servis->servisBarangPetugas->petugas->nama ?? 'Belum Ditugaskan' }}
                                </td>
                                <td>
                                    <div class="badge badge-light-{{ $servis->status == 'paid' ? 'success' : ($servis->status == 'pending' ? 'warning' : 'danger') }} fs-5">
                                        {{ ucfirst($servis->status) }}
                                    </div>
                                </td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn-outline btn-outline-primary btn-sm btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editStatusModal"
                                        data-id="{{ $servis->id }}"
                                        data-status="{{ $servis->status }}">
                                        <i class="ki-duotone ki-pencil fs-2"></i>
                                    </button>
                                    <button class="btn btn-icon btn-outline btn-outline-success btn-sm btn-pilih-petugas"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalPenugasan"
                                        data-id="{{ $servis->id }}">
                                        <i class="ki-duotone ki-user fs-2"></i>
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
                    <input type="hidden" id="servisBarangId" name="servis_barang_id">
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
            <form id="formPenugasan" method="POST" action="{{ route('orderServisBarang.petugas') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="servis_barang_id" name="servis_barang_id">

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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const servisBarangId = this.getAttribute('data-id');
                const servisStatus = this.getAttribute('data-status');

                console.log('Servis ID:', servisBarangId); // Debugging
                console.log('Status:', servisStatus); // Debugging

                // Mengatur nilai pada modal
                document.getElementById('servisBarangId').value = servisBarangId;
                document.getElementById('status').value = servisStatus;
            });
        });
    });

    // Mengirim form update status melalui AJAX
    document.getElementById('editStatusForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const servisBarangId = document.getElementById('servisBarangId').value;
        const status = document.getElementById('status').value;

        fetch(`/order-servis-barang/${servisBarangId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
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
                document.getElementById("servis_barang_id").value = servisId; // Set ID servis ke input hidden
            });
        });
    });
</script>


@endsection