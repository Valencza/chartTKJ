@extends('home.layouts.app')

@section('content')

<style>
    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        white-space: nowrap;
    }

    .small-title {
        font-size: 22px !important;
    }
</style>

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
                            <li class="breadcrumb-item"><a href="#" class=" text-primary">Check Out</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumbs end -->

    <!-- Card Invoice -->
    <section class="container" style="margin-top: -50px;">
        <div class="row">
            <div class="col-lg-5 col-md-12 mb-5">
                <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div id="form-checkout-card" class="card shadow-md border-0 p-lg-4 p-md-4 p-2">
                        <div class="card-body">
                            <h4 class="fw-bold mb-4 pb-2 d-flex align-items-center">
                                <span class="icon-wrapper px-3 rounded-circle me-3" style="background-color: #e0efff;padding: 13px 0px;">
                                    <i class="bi bi-cart-check-fill text-primary"></i>
                                </span>
                                Form Checkout
                            </h4>
                            @foreach($keranjang as $item)
                            <input type="hidden" name="produk_id[]" value="{{ $item['produk']->id }}">
                            <input type="hidden" name="jumlah[]" value="{{ $item['jumlah'] }}">
                            @endforeach
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: 500;">Nama Lengkap :</label>
                                <input type="text" class="form-control" name="nama" value="{{ auth()->user()->nama }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: 500;">Email :</label>
                                <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" style="font-weight: 500;">Nomor Telepon :</label>
                                <input type="text" class="form-control" name="no_telpon" id="no-telpon"
                                    value="{{ $alamatList->first()->no_telpon ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Alamat Pengiriman :</label>
                                <select class="form-control" name="alamat" id="alamat-select">
                                    @foreach($alamatList as $alamat)
                                    <option value="{{ $alamat->id }}" data-no_telpon="{{ $alamat->no_telpon ?? '' }}"
                                        {{ $loop->first ? 'selected' : '' }}>
                                        {{ $alamat->alamat }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button id="pay-button" type="submit" class="btn btn-primary w-100 mt-3 py-2 rounded" data-url="{{ route('checkout.store') }}">
                                Lanjutkan Pembayaran
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-7 col-md-12 mb-5">
                <div id="barang-card" class="card shadow-md border-0 p-lg-4 p-md-4 p-2">
                    <div class="card-body justify-content-start">
                        <h4 class="fw-bold mb-4 pb-2 d-flex align-items-center">
                            <span class="icon-wrapper px-3 rounded-circle me-3" style="background-color: #e0efff; padding: 13px 0px;">
                                <i class="bi bi-box-fill text-primary"></i>
                            </span>
                            Detail Barang
                        </h4>
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
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>{{ $produk->nama }}</td>
                                        <td class="text-end">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $jumlah }}</td>
                                        <td class="text-end">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Subtotal:</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Diskon:</td>
                                        <td class="text-end text-primary">
                                            @if($diskon !== '')
                                            Rp {{ number_format($diskon, 0, ',', '.') }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold">Total Pembayaran:</td>
                                        <td class="text-end total-harga">Rp {{ number_format($total, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</main>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', async function(event) {
        event.preventDefault();

        let form = document.getElementById('checkout-form');
        let formData = new FormData(form);

        // Konversi FormData ke objek JSON
        let data = {};
        formData.forEach((value, key) => {
            if (key.includes('[]')) {
                key = key.replace('[]', '');
                if (!data[key]) data[key] = [];
                data[key].push(value);
            } else {
                data[key] = value;
            }
        });

        console.log("Mengirim data form:", data);

        try {
            let response = await fetch(form.getAttribute('action'), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            let result = await response.json();
            console.log("Response dari server:", result);

            if (response.ok) {
                snap.pay(result.snapToken, {
                    onSuccess: function(result) {
                        console.log("Pembayaran sukses:", result);
                        // Redirect ke invoice dengan order_id yang dikembalikan dari Midtrans
                        window.location.href = "/invoice-barang?order_id=" + result.order_id;
                    },
                    onPending: function(result) {
                        console.log("Pembayaran pending:", result);
                        // Tetap redirect ke invoice meskipun pending
                        window.location.href = "/invoice-barang?order_id=" + result.order_id;
                    },
                    onClose: function() {
                        console.log("Snap Midtrans ditutup oleh user.");
                        alert('Pembayaran belum selesai!');
                        // Redirect ke halaman invoice agar user bisa coba bayar lagi
                        window.location.href = "/invoice-barang" + result.order_id;
                    }
                });
            } else {
                alert('Kesalahan: ' + result.error);
            }
        } catch (error) {
            console.error("Fetch error:", error);
            alert('Terjadi kesalahan, coba lagi.');
        }
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let alamatSelect = document.getElementById("alamat-select");
        let noTelponInput = document.getElementById("no-telpon");

        function updateNoTelpon() {
            let selectedOption = alamatSelect.options[alamatSelect.selectedIndex];
            let noTelpon = selectedOption.getAttribute("data-no_telpon") || "";
            noTelponInput.value = noTelpon;
        }

        // Update nomor telepon saat halaman dimuat
        updateNoTelpon();

        // Update nomor telepon saat dropdown berubah
        alamatSelect.addEventListener("change", updateNoTelpon);
    });
</script>

@endsection