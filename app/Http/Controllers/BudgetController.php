<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\Expense;

class BudgetController extends Controller
{
    public function index()
    {
        $budget = Budget::where('user_id', auth()->id())->first();
        $expenses = Expense::where('user_id', auth()->id())
                           ->whereMonth('date', now()->month)
                           ->sum('amount');

        return view('budget.index', compact('budget', 'expenses'));
    }

    public function update(Request $request)
    {
        $request->validate(['monthly_limit' => 'required|numeric|min:1']);

        Budget::updateOrCreate(
            ['user_id' => auth()->id()],
            ['monthly_limit' => $request->monthly_limit]
        );

        return redirect()->back()->with('success', 'Budget updated!');
    }
}

