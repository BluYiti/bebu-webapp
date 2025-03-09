<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use App\Models\Budget;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id(); // Get the logged-in user's ID

        // Get total income for the user
        $totalIncome = Income::where('user_id', $userId)->sum('amount');
        
        // Get total expenses for the user
        $totalExpenses = Expense::where('user_id', $userId)->sum('amount');
        
        // Get the user's active budget
        $activeBudget = Budget::where('user_id', $userId)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        $budgetRemaining = $activeBudget ? $activeBudget->amount - $totalExpenses : 0;

        return view('dashboard', compact('totalIncome', 'totalExpenses', 'budgetRemaining'));
    }
}
