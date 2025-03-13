<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    // 1. Generate Token Pembayaran
    public function getSnapToken(Request $request)
    {
        try {
            // Simpan order ke database sebelum transaksi dimulai
            $order = Order::create([
                'user_id' => auth()->id(),
                'harga' => $request->harga,
                'status' => 'pending'
            ]);

            // Data transaksi Midtrans
            $transaction = [
                'transaction_details' => [
                    'order_id' => $order->id,
                    'gross_amount' => $order->harga,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
                'callbacks' => [
                    'finish' => route('midtrans.callback')
                ]
            ];

            // Buat Snap Token
            $snapToken = Snap::getSnapToken($transaction);
            return response()->json(['snap_token' => $snapToken]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // 2. Callback Midtrans (Menangani Status Pembayaran)
    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $signatureKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($signatureKey != $request->signature_key) {
            return response()->json(['error' => 'Invalid Signature'], 403);
        }

        $order = Order::where('id', $request->order_id)->first();
        if (!$order) {
            return response()->json(['error' => 'Order Not Found'], 404);
        }

        // Update status pembayaran
        if ($request->transaction_status == 'settlement') {
            $order->status = 'paid';
        } elseif ($request->transaction_status == 'pending') {
            $order->status = 'pending';
        } elseif (in_array($request->transaction_status, ['deny', 'expire', 'cancel'])) {
            $order->status = 'failed';
        }

        $order->save();
        return response()->json(['message' => 'Payment status updated']);
    }

    // 3. Cek Status Pembayaran
    public function checkPaymentStatus($order_id)
    {
        $order = Order::find($order_id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json(['status' => $order->status]);
    }
}
