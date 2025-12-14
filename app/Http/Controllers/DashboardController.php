<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Budget
        $budget = $user->budget ?? 0;

        // Current month expenses
        $monthlyExpenses = $user->transactions()
            ->where('type', 'expense')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        $remaining = $budget - $monthlyExpenses;

        // Totals
        $income = $user->transactions()->where('type', 'income')->sum('amount');
        $expenses = $user->transactions()->where('type', 'expense')->sum('amount');
        $balance = $income - $expenses;

        // Recent transactions
        $transactions = $user->transactions()->latest()->get();

        // ✅ MONTHLY HISTORY (SAFE + SIMPLE)
        $monthlyHistory = $user->transactions()
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(amount) as total')
            ->where('type', 'expense')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('dashboard', compact(
            'budget',
            'monthlyExpenses',
            'remaining',
            'income',
            'expenses',
            'balance',
            'transactions',
            'monthlyHistory' // ✅ NOW DEFINED
        ));
    }


    public function updateBudget(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric|min:0'
        ]);

        $user = auth()->user();
        $user->budget = $request->budget;
        $user->save();

        return back()->with('success', 'Budget updated!');
    }
}
