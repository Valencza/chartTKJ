<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .text-end { text-align: right; }
        .text-center { text-align: center; }
        .fw-bold { font-weight: bold; }
    </style>
</head>
<body>

    <h2 class="fw-bold">Invoice</h2>
    <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>
    <p><strong>Penerima:</strong> {{ $order->user->nama }}</p>
    <p><strong>Penerima:</strong> ({{ $order->user->email }})</p>

    <table>
        <thead>
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

    <p><strong>Catatan:</strong> 
    <p>Barang yang sudah dibeli <strong>tidak dapat dikembalikan</strong>, kecuali ada cacat produksi.</p>
    <p>Simpan invoice ini sebagai <strong>pembelian yang sah</strong>.</p>
    <p>Jika ada pertanyaan, silakan hubungi <strong>customer service kami</strong>.</p>   

</body>
</html>
