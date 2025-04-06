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
                                <th class="pe-3 min-w-150px">Email</th>
                                <th class="pe-3 min-w-150px">No Telp</th>
                                <th class="pe-3 min-w-150px">Role</th>
                                <th class="text-center pe-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($users as $index => $user)
                            <tr>
                                <!-- Menggunakan nomor urut -->
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $user->nama ?? '-' }}</td>
                                <td>{{ $user->email ?? '-' }}</td>
                                <td>{{ $user->no_telpon ?? '-' }}</td>
                                <td>
                                    <div class="badge badge-light-{{ 
                                                    $user->role == 'admin' ? 'success' : 
                                                    ($user->role == 'user' ? 'warning' : 
                                                    ($user->role == 'petugas' ? 'danger' : 'secondary')) 
                                                }} fs-5">
                                        {{ ucfirst($user->role) }}
                                    </div>
                                </td>
                                <td class="text-end text-nowrap">
                                    <button class="btn btn-icon btn-outline btn-outline-primary btn-sm btn-edit"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editStatusModal"
                                        data-id="{{ $user->id }}"
                                        data-status="{{ $user->role }}">
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
<div class="modal fade" id="editStatusModal" tabindex="-1" aria-labelledby="editStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStatusModalLabel">Edit Role User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editStatusForm">
                    @csrf
                    <input type="hidden" id="userId" name="userId">
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="user">User</option>
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
                const userId = this.getAttribute('data-id');
                const role = this.getAttribute('data-status');

                console.log('User ID:', userId); // Debugging
                console.log('Role:', role); // Debugging

                // Mengatur nilai pada modal
                document.getElementById('userId').value = userId;
                document.getElementById('role').value = role;
            });
        });
    });

    // Mengirim form update status melalui AJAX
    document.getElementById('editStatusForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const userId = document.getElementById('userId').value;
        const role = document.getElementById('role').value;

        fetch(`/dashboard/user/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    role: role
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