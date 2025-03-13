<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        // Mendapatkan bulan dan tahun saat ini
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Menghitung total pendapatan berdasarkan status 'paid' pada bulan dan tahun ini
        $totalPendapatan = OrderItem::whereHas('order', function ($query) use ($currentMonth, $currentYear) {
            $query->where('status', 'paid')
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear);
        })->sum(DB::raw('harga * jumlah'));

        // Mengirim totalPendapatan ke view dashboard.index
        return view('dashboard.index', compact('totalPendapatan'));
    }

    // Method untuk mengambil data pendapatan untuk grafik
    public function getPendapatanGrafik(Request $request)
    {
        $filter = $request->query('filter', 'year');
        $labels = [];
        $data = [];

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        switch ($filter) {
            case 'year':
                // Data untuk satu tahun
                for ($month = 1; $month <= 12; $month++) {
                    $labels[] = Carbon::create()->month($month)->format('F');
                    $pendapatan = OrderItem::whereHas('order', function ($query) use ($month, $currentYear) {
                        $query->where('status', 'paid')
                            ->whereMonth('created_at', $month)
                            ->whereYear('created_at', $currentYear);
                    })->sum(DB::raw('harga * jumlah'));
                    $data[] = $pendapatan;
                }
                break;

            case 'month':
                // Data untuk bulan ini
                $labels[] = Carbon::now()->format('F');
                $pendapatan = OrderItem::whereHas('order', function ($query) use ($currentMonth, $currentYear) {
                    $query->where('status', 'paid')
                        ->whereMonth('created_at', $currentMonth)
                        ->whereYear('created_at', $currentYear);
                })->sum(DB::raw('harga * jumlah'));
                $data[] = $pendapatan;
                break;

            case 'last_month':
                // Data untuk bulan lalu
                $lastMonth = Carbon::now()->subMonth();
                $labels[] = $lastMonth->format('F');
                $pendapatan = OrderItem::whereHas('order', function ($query) use ($lastMonth) {
                    $query->where('status', 'paid')
                        ->whereMonth('created_at', $lastMonth->month)
                        ->whereYear('created_at', $lastMonth->year);
                })->sum(DB::raw('harga * jumlah'));
                $data[] = $pendapatan;
                break;

            case 'week':
                // Data untuk minggu ini
                $labels[] = Carbon::now()->startOfWeek()->format('d M') . ' - ' . Carbon::now()->endOfWeek()->format('d M');
                $pendapatan = OrderItem::whereHas('order', function ($query) {
                    $query->where('status', 'paid')
                        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                })->sum(DB::raw('harga * jumlah'));
                $data[] = $pendapatan;
                break;

            case 'custom':
                // Data untuk custom tanggal, handled in the frontend
                break;
        }

        // Mengembalikan data dalam bentuk JSON
        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
