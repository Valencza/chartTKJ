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
                    @if ($notifikasiOrder->isNotEmpty())
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="table">
                        <thead class="fw-bold fs-7 text-uppercase text-gray-900 text-nowrap bg-gray-100">
                            <tr>
                                <th class="text-center pe-3 min-w-80px">ID</th>
                                <th class="pe-3 min-w-200px">Notifikasi</th>
                                <th class="pe-3 min-w-150px">Produk</th>
                                <th class="pe-3 min-w-150px">Nama</th>
                                <th class="pe-3 min-w-150px">Jumlah</th>
                                <th class="pe-3 min-w-150px">Harga</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-700">
                            @foreach ($notifikasiOrder as $order)
                            @foreach ($order->notifikasi->where('order_id', $order->id) as $notif) <!-- Pastikan notifikasi terkait dengan order_id -->
                            @foreach ($order->items as $item)
                            @if ($item->order_id == $order->id) <!-- Pastikan order_item terkait dengan order_id -->
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>
                                <td>{{ $notif->pesan }}</td>
                                <td>{{ $item->produk->nama ?? 'Tidak Tersedia' }}</td> <!-- Menampilkan nama produk -->
                                <td>{{ $order->user->nama ?? 'Tidak Tersedia' }}</td> <!-- Menampilkan nama pengguna -->
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</td>
                            </tr>
                            @endif
                            @endforeach
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-center">Tidak ada notifikasi dengan produk terkait.</p>
                    @endif


                </div>
                <!--end::Table-->
            </div>
        </div>
    </div>
</div>
<!--end content-->

@endsection