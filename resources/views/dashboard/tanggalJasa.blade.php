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
                                <th class="pe-3 min-w-150px">Jenis Layanan</th>
                                <th class="pe-3 min-w-150px">Alamat</th>
                                <th class="pe-3 min-w-150px">Telepon</th>
                                <th class="pe-3 min-w-150px">Tanggal</th>
                                <th class="pe-3 min-w-150px">Proses</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($informasiTanggal as $tanggal)
                            <tr>
                                <td class="text-center">{{ $tanggal->servisJasa->order_id }}</td>
                                <td>{{ $tanggal->servisJasa->user->nama ?? 'Tidak Ada Nama' }}</td>
                                <td>{{ $tanggal->servisJasa->petugas->nama ?? 'Belum Ditugaskan' }}</td>
                                <td>{{ $tanggal->servisJasa->jenisJasa?->nama ?? 'Layanan Tidak Tersedia' }}</td>
                                <td>{{ $tanggal->servisJasa->alamat ?? 'Alamat Tidak Ada' }}</td>
                                <td>{{ $tanggal->servisJasa->telepon ?? 'Telepon Tidak Ada' }}</td>
                                <td>{{ $tanggal->tanggal ? \Carbon\Carbon::parse($tanggal->tanggal)->format('d-m-Y') : 'Negosiasi' }}</td>
                                <td>{{ $tanggal->servisJasa->proses ?? 'Menunggu' }}</td>
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

@endsection