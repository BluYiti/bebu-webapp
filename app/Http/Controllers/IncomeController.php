<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;

class IncomeController extends Controller
{
    public function index()
    {
        $expenses = Income::where('user_id', auth()->id())->latest()->get();
        return view('income.index', compact('income'));
    }
}
