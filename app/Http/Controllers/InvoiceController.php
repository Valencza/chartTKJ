<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class InvoiceController extends Controller
{
    public function showInvoice(Request $request)
    {
        $order = Order::where('id', $request->order_id)->first();

        if (!$order) {
            abort(404, 'Order tidak ditemukan.');
        }
        
        return view('home.invoiceBarang', compact('order'));
    }

    public function downloadInvoice($orderId)
    {
        $order = Order::findOrFail($orderId);

        $pdf = PDF::loadView('home.invoice-pdf', compact('order'));
        return $pdf->download('invoice_'.$order->id.'.pdf');
    }
}
