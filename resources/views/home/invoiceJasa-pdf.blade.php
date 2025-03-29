<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { width: 100%; max-width: 800px; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; text-align: center; }
        .text-end { text-align: right; }
        .fw-bold { font-weight: bold; }
        .text-danger { color: red; }
        .text-success { color: green; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Invoice #{{ $servisJasa->order_id }}</h2>
            <p>Tanggal: {{ $servisJasa->created_at->format('d M Y') }}</p>
        </div>

        <table class="table">
            <tr>
                <th>Nama Pelanggan</th>
                <td>{{ $servisJasa->user->nama ?? 'Pelanggan' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $servisJasa->user->email ?? '-' }}</td>
            </tr>
        </table>

        <h3>Detail Servis</h3>
        <table class="table">
            <thead class="table-light">
                <tr class="text-center">
                    <th style="width: 5%;">No</th>
                    <th style="width: 25%;">Layanan</th>
                    <th style="width: 15%;">Harga Jasa</th>
                    <th style="width: 25%;">Deskripsi</th>
                    <th style="width: 30%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $subtotal = 0;
                $diskon = $servisJasa->diskon ?? 0;
                $harga = $servisJasa->harga ?? 0;
                $harga_tambahan = $servisJasa->harga_tambahan ?? 0;
                $total = $harga + $harga_tambahan;
                $subtotal += $total;
                @endphp

                <tr>
                    <td class="text-center">1</td>
                    <td>{{ $servisJasa->jenisJasa->nama ?? '-' }}</td>
                    <td class="text-end">Rp {{ number_format($harga, 0, ',', '.') }}</td>
                    <td>{{ $servisJasa->deskripsi ?? '-' }}</td>
                    <td class="text-end">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>

                <tr>
                    <td colspan="5" class="text-end fw-bold">Subtotal:</td>
                    <td class="text-end fw-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end fw-bold">Diskon:</td>
                    <td class="text-end text-success">- Rp {{ number_format($diskon, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end fw-bold">Total Pembayaran:</td>
                    <td class="text-end fw-bold text-danger">
                        Rp {{ number_format($subtotal - $diskon, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        <p>Terima kasih telah menggunakan layanan kami!</p>
    </div>
</body>
</html>
