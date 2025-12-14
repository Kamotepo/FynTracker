<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class MonthlyHistoryController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Group transactions by month
        $monthlyHistory = $user->transactions()
            ->selectRaw('
                YEAR(created_at) as year,
                MONTH(created_at) as month,
                SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as income,
                SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as expenses
            ')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('monthly-history', compact('monthlyHistory'));
    }
}
