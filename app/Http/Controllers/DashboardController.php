<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Budget;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalIncome = Income::where('user_id', $user->id)->sum('amount');
        $totalExpenses = Expense::where('user_id', $user->id)->sum('amount');
        $budgetLimit = Budget::where('user_id', $user->id)->value('monthly_limit');

        $budgetRemaining = $budgetLimit - $totalExpenses;

        return view('dashboard', compact('totalIncome', 'totalExpenses', 'budgetRemaining'));
    }
}
