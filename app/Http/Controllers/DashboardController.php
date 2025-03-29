<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\ServisBarang;
use App\Models\ServisJasa;
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
        $totalPendapatanProduk = OrderItem::whereHas('order', function ($query) use ($currentMonth, $currentYear) {
            $query->where('status', 'paid')
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear);
        })->sum(DB::raw('harga * jumlah'));

        // Menghitung total pendapatan dari ServisBarang berdasarkan status 'paid'
        $totalPendapatanServis = ServisBarang::where('status', 'paid')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('harga'); // Tidak dikali jumlah

        // Menghitung total pendapatan dari ServisBarang berdasarkan status 'paid'
        $totalPendapatanJasa = ServisJasa::where('status', 'paid')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('harga'); // Tidak dikali jumlah

        // Menghitung total keseluruhan pendapatan
        $totalPendapatanKeseluruhan = $totalPendapatanProduk + $totalPendapatanServis + $totalPendapatanJasa;

        // Mengirim totalPendapatan ke view dashboard.index
        return view('dashboard.index', compact('totalPendapatanProduk', 'totalPendapatanServis', 'totalPendapatanJasa', 'totalPendapatanKeseluruhan'));
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

    public function getPendapatanServis(Request $request)
    {
        $filter = $request->query('filter', 'year');
        $labels = [];
        $data = [];

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        switch ($filter) {
            case 'year':
                for ($month = 1; $month <= 12; $month++) {
                    $labels[] = Carbon::create()->month($month)->format('F');
                    $pendapatan = ServisBarang::where('status', 'paid')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $currentYear)
                        ->sum('harga');
                    $data[] = (int) $pendapatan; // Pastikan integer
                }
                break;

            case 'month':
                $labels[] = Carbon::now()->format('F');
                $pendapatan = ServisBarang::where('status', 'paid')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->sum('harga');
                $data[] = (int) $pendapatan; // Pastikan integer
                break;

            case 'last_month':
                $lastMonth = Carbon::now()->subMonth();
                $labels[] = $lastMonth->format('F');
                $pendapatan = ServisBarang::where('status', 'paid')
                    ->whereMonth('created_at', $lastMonth->month)
                    ->whereYear('created_at', $lastMonth->year)
                    ->sum('harga');
                $data[] = (int) $pendapatan; // Pastikan integer
                break;

            case 'week':
                $labels[] = Carbon::now()->startOfWeek()->format('d M') . ' - ' . Carbon::now()->endOfWeek()->format('d M');
                $pendapatan = ServisBarang::where('status', 'paid')
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->sum('harga');
                $data[] = (int) $pendapatan; // Pastikan integer
                break;

            case 'custom':
                $customDate = $request->query('date');
                if (!$customDate) {
                    return response()->json(['error' => 'Tanggal tidak valid'], 400);
                }
                $labels[] = $customDate;
                $pendapatan = ServisBarang::where('status', 'paid')
                    ->whereDate('created_at', $customDate)
                    ->sum('harga');
                $data[] = (int) $pendapatan; // Pastikan integer
                break;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }

    public function getPendapatanLayanan(Request $request)
    {
        $filter = $request->query('filter', 'year');
        $labels = [];
        $data = [];

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        switch ($filter) {
            case 'year':
                for ($month = 1; $month <= 12; $month++) {
                    $labels[] = Carbon::create()->month($month)->format('F');
                    $pendapatan = ServisJasa::where('status', 'paid')
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $currentYear)
                        ->sum('harga');
                    $data[] = (int) $pendapatan; // Pastikan integer
                }
                break;

            case 'month':
                $labels[] = Carbon::now()->format('F');
                $pendapatan = ServisJasa::where('status', 'paid')
                    ->whereMonth('created_at', $currentMonth)
                    ->whereYear('created_at', $currentYear)
                    ->sum('harga');
                $data[] = (int) $pendapatan; // Pastikan integer
                break;

            case 'last_month':
                $lastMonth = Carbon::now()->subMonth();
                $labels[] = $lastMonth->format('F');
                $pendapatan = ServisJasa::where('status', 'paid')
                    ->whereMonth('created_at', $lastMonth->month)
                    ->whereYear('created_at', $lastMonth->year)
                    ->sum('harga');
                $data[] = (int) $pendapatan; // Pastikan integer
                break;

            case 'week':
                $labels[] = Carbon::now()->startOfWeek()->format('d M') . ' - ' . Carbon::now()->endOfWeek()->format('d M');
                $pendapatan = ServisJasa::where('status', 'paid')
                    ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->sum('harga');
                $data[] = (int) $pendapatan; // Pastikan integer
                break;

            case 'custom':
                $customDate = $request->query('date');
                if (!$customDate) {
                    return response()->json(['error' => 'Tanggal tidak valid'], 400);
                }
                $labels[] = $customDate;
                $pendapatan = ServisJasa::where('status', 'paid')
                    ->whereDate('created_at', $customDate)
                    ->sum('harga');
                $data[] = (int) $pendapatan; // Pastikan integer
                break;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
