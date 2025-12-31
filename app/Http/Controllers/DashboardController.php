<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $month = now()->month;
        $year  = now()->year;

        $totalMonth = \App\Models\ExpenseVoucher::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->sum('total');

        $countMonth = \App\Models\ExpenseVoucher::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->count();

        $totalKas = \App\Models\ExpenseVoucher::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('payment_method', 'KAS')
            ->sum('total');

        $totalBank = \App\Models\ExpenseVoucher::whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('payment_method', 'BANK')
            ->sum('total');

        $latestVoucher = \App\Models\ExpenseVoucher::latest('date')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalMonth',
            'countMonth',
            'totalKas',
            'totalBank',
            'latestVoucher'
        ));
    }
}
