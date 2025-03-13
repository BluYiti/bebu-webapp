<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::all(); // Fetch all budgets
        return view('budget.index', compact('budgets'));
    }    

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
    
        Budget::create([
            'user_id' => Auth::id(), // Get the currently logged-in user's ID
            'category' => $request->category,
            'amount' => $request->amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
    
        return redirect()->route('budget.index')->with('success', 'Budget created successfully!');
    }

    public function show($id)
    {
        $budget = Budget::findOrFail($id);
        return response()->json($budget);
    }

    public function create()
    {
        return view('budget.create'); // Ensure you have a create.blade.php file
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $budget = Budget::findOrFail($id);
        $budget->update($request->all());

        return response()->json($budget);
    }

    public function destroy($id)
    {
        $budget = Budget::findOrFail($id);
        $budget->delete();

        return response()->json(null, 204);
    }
}
