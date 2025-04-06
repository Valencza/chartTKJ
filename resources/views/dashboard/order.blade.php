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
                                <th class="text-center pe-3 min-w-80px">ID</th>
                                <th class="pe-3 min-w-80px">Nama Pembeli</th>
                                <th class="pe-3 min-w-150px">Produk</th>
                                <th class="pe-3 min-w-150px">Jumlah</th>
                                <th class="pe-3 min-w-150px">Total Harga</th>
                                <th class="pe-3 min-w-150px">Tanggal Order</th>
                                <th class="pe-3 min-w-150px">Status</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($orders as $order)
                            @foreach ($order->items as $item)
                            <tr>
                                <!-- Menampilkan order_id yang diambil dari item -->
                                <td class="text-center">{{ $item->order_id }}</td>
                                <td>{{ $order->pembeli->nama ?? 'Nama Tidak Tersedia' }}</td>
                                <td>{{ $item->produk->nama ?? 'Produk Tidak Tersedia' }}</td>
                                <td>{{ $item->jumlah ?? 'Jumlah Tidak Tersedia' }}</td>
                                <td>Rp. {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
                                <td>
                                    <div class="badge badge-light-{{ $order->status == 'paid' ? 'success' : ($order->status == 'pending' ? 'warning' : 'danger') }} fs-5">
                                        {{ ucfirst($order->status) }}
                                    </div>
                                </td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn-outline btn-outline-primary btn-sm btn-edit" data-bs-toggle="modal" data-bs-target="#editStatusModal" data-id="{{ $order->id }}" data-status="{{ $order->status }}">
                                        <i class="fas fa-pen fs-2"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
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
                <h5 class="modal-title" id="editStatusModalLabel">Edit Status Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStatusForm">
                    @csrf
                    <input type="hidden" id="orderId" name="order_id">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.btn-edit');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const orderId = this.getAttribute('data-id');
                const orderStatus = this.getAttribute('data-status');

                console.log('Order ID:', orderId); // Debugging
                console.log('Order Status:', orderStatus); // Debugging

                // Mengatur nilai pada modal
                document.getElementById('orderId').value = orderId;
                document.getElementById('status').value = orderStatus;
            });
        });
    });

    // Mengirim form update status melalui AJAX
    document.getElementById('editStatusForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const orderId = document.getElementById('orderId').value;
        const status = document.getElementById('status').value;

        fetch(`/order/${orderId}`, {
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

@endsection