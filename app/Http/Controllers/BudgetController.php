<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        $user->budget = $request->budget;
        $user->save();

        return redirect()->back()->with('success', 'Budget updated!');
    }
}
