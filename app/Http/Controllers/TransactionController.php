<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'category' => 'required',
            'type' => 'required|in:income,expense',
        ]);

        Transaction::create([
            'description' => $request->description,
            'amount' => $request->amount,
            'category' => $request->category,
            'type' => $request->type,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Transaction added!');
    }

    public function index()
    {
        $user = Auth::user();

        // --- Basic data (income, expenses, balance)
        $transactions = Transaction::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();

        $income = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->sum('amount');

        $expenses = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->sum('amount');

        $balance = $income - $expenses;

        // --- NEW: Budget from users table
        $budget = $user->budget ?? 0;

        // --- NEW: Monthly expenses
        $monthlyExpenses = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        // --- NEW: Remaining before hitting budget
        $remaining = $budget - $monthlyExpenses;

        return view('dashboard', [
            'transactions'      => $transactions,
            'income'            => $income,
            'expenses'          => $expenses,
            'balance'           => $balance,
            'budget'            => $budget,
            'monthlyExpenses'   => $monthlyExpenses,
            'remaining'         => $remaining,
        ]);
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'category' => 'required',
            'type' => 'required|in:income,expense',
        ]);

        $transaction->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Transaction updated!');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('dashboard')->with('success', 'Transaction deleted!');
    }
}
