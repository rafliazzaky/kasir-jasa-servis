<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        // Rekap Harian Total Transaksi & Pendapatan
        $reports = Transaction::with('user')
            ->selectRaw('DATE(created_at) as date, COUNT(id) as total_transactions, SUM(total_price) as total_revenue')
            ->groupBy('date')
            ->orderBy('date', 'DESC')
            ->get();

        // Total Keseluruhan Pendapatan
        $grandTotal = Transaction::sum('total_price');

        return view('reports.index', compact('reports', 'grandTotal'));
    }
}