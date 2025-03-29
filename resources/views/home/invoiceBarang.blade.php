@extends('home.layouts.app')

<style>
    /* Media query khusus untuk saat mencetak */
    @media print {

        /* Mengatur body agar layout mengikuti desktop */
        body {
            width: 100%;
            margin: 0;
        }

        /* Pastikan #invoice-card mengambil layout desktop */
        #invoice-card {
            width: 100%;
            overflow: visible;
        }

        /* Tambahkan gaya tambahan jika perlu */
        .card-body {
            padding: 20px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: visible;
        }

        /* Menyembunyikan elemen yang tidak perlu dicetak, misalnya elemen untuk mobile */
        @media (max-width: 425px) {
            body {
                display: none;
            }
        }
    }


    @media (max-width: 768px) {
        .remove-br br {
            display: none;
        }

        .fw-bold.fs-4 {
            font-size: 18px !important;
        }

        .table {
            font-size: 14px;
        }

        .note p {
            font-size: 14px;
        }

        .judul p {
            font-size: 15px;
        }
    }

    @media (max-width: 425px) {
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            white-space: nowrap;
        }

        .card-body img {
            width: 160px;
        }

        .judul p.sub-judul {
            font-size: 12px;
        }

        .judul p.user {
            font-size: 13px;
        }

        .table {
            font-size: 12px;
        }

        .row p.date {
            font-size: 13px;
        }

        .row .note p.text-muted {
            font-size: 11px;
        }

        .row p.judul-note {
            font-size: 13px;
        }
    }

    @media (max-width: 375px) {
        .card-body img {
            width: 130px;
        }

        .judul p.sub-judul {
            font-size: 10px;
        }

        .judul p.user {
            font-size: 11px;
        }

        .table {
            font-size: 10px;
        }

        .row p.date {
            font-size: 12px;
        }

        .row .note p.text-muted {
            font-size: 10px;
        }

        .row p.judul-note {
            font-size: 12px;
        }

        .invoice p.judul-invoice {
            font-size: 12px;
        }

        .judul p.judul-2 {
            font-size: 12.3px;
        }
    }

    @media (max-width: 320px) {
        .card-body img {
            width: 110px;
        }

        .judul p.sub-judul {
            font-size: 9px;
        }

        .judul p.user {
            font-size: 9px;
        }

        .table {
            font-size: 9px;
        }

        .row p.date {
            font-size: 10px;
        }

        .row .note p.text-muted {
            font-size: 9px;
        }

        .row p.judul-note {
            font-size: 10px;
        }

        .invoice p.judul-invoice {
            font-size: 11px;
        }

        .judul p.judul-2 {
            font-size: 10px;
        }
    }
</style>

@section('content')

<main class="main">
    <!-- Breadcrumbs start -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container mt-5 pt-5">
            <div class="row align-items-center">
                <div class="col-lg-12 mt-4">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html" class="text-secondary">
                                    <i class="bi bi-house-door icon" style="font-size: 19px;"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route ('pembelian') }}" class="text-secondary">Pembelian</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-secondary">Detail Barang</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-secondary">Check Out</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Invoice</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumbs end -->

    <!-- Card Invoice -->
    <section class="container" style="margin-top: -50px;">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div id="invoice-card" class="card shadow-md border-0 p-lg-5 p-md-5 p-2">
                    <div class="card-body">
                        <div class="row py-2">
                            <div class="col-lg-6 col-md-6 col-6 mb-lg-5 mb-md-5 mb-4">
                                <img src="{{ asset('assets/user/img/LOGO.svg') }}" alt="">
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 text-lg-end text-end mb-lg-4 mb-md-5 mb-4 invoice">
                                <p class="fw-bold fs-lg-4 fs-md-4 fs-custom mb-0 judul-invoice">INVOICE</p>
                                <p class="text-muted date">Tanggal : {{ $order->created_at->format('d M Y') }}</p>
                            </div>
                        </div>

                        <div class="row judul">
                            <div class="col-lg-6 col-md-6 col-6 mb-5">
                                <p class="fw-bold judul-2">Diterbitkan oleh :</p>
                                <p class="mb-0 sub-judul">UPJ TKJ SMKN 4 Malang</p>
                                <p class="mb-0 remove-br sub-judul">Jl. Tanimbar No.22, Kasin, Kec. Klojen, <br> Kota Malang, Jawa Timur 65117</p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6 text-lg-end text-end mb-5">
                                <p class="fw-bold judul-2">Dibeli oleh:</p>
                                <p class="mb-0 user">Nama : {{ $order->user->nama }}</p>
                                <p class="mb-0 user">Email : {{ $order->user->email }}</p>
                                <!-- <p class="mb-0 user">Status : {{ $order->status }}</p> -->
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ $key+1 }}</td>
                                        <td>{{ $item->produk->nama }}</td>
                                        <td class="text-end">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $item->jumlah }}</td>
                                        <td class="text-end">Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Subtotal:</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Diskon:</td>
                                        <td class="text-end text-success">- Rp {{ number_format($order->diskon, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Total Pembayaran:</td>
                                        <td class="text-end fw-bold text-danger">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 note">
                                <p class="fw-bold judul-note">Catatan:</p>
                                <p class="text-muted mb-0">✔️ Barang yang sudah dibeli **tidak dapat dikembalikan**, kecuali ada cacat produksi.</p>
                                <p class="text-muted mb-0">✔️ Simpan invoice ini sebagai **bukti pembelian yang sah**.</p>
                                <p class="text-muted mb-0">✔️ Jika ada pertanyaan, silakan hubungi **customer service kami**.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-5">
            <a href="{{ route('riwayat') }}" class="btn btn-primary py-lg-3 py-md-3 py-3 px-lg-4 px-md-3 px-3">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>

            <a href="{{ route('invoice.download', $order->id) }}" class="btn btn-primary py-lg-3 py-md-3 py-3 px-lg-4 px-md-3 px-3">
                <i class="bi bi-download me-1"></i> Cetak Invoice
            </a>
        </div>
    </section>
</main>

<!-- js tanggal invoice -->
<script>
    document.getElementById("invoice-date").innerText = new Date().toLocaleDateString();
</script>

<!-- js print -->
<script>
    function printInvoice() {
        let printContent = document.getElementById("invoice-card").innerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload();
    }
</script>

<script>
    document.querySelectorAll('.dropdown-toggle').forEach(function(dropdown) {
        new bootstrap.Dropdown(dropdown, {
            popperConfig: function() {
                return {
                    modifiers: [{
                        name: 'preventOverflow',
                        options: {
                            boundary: 'window'
                        }, // Ubah boundary ke 'window'
                    }, ],
                };
            },
        });
    });
</script>


@endsection