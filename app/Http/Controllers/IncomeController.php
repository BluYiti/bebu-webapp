<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::all();
        return view('income.index', compact('incomes'));
    }

    public function create()
    {
        return view('income.create');
    }

    public function store(Request $request)
    {
        // Assuming the user is logged in and you want to save the income under the logged-in user
        $request->validate([
            'source' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);
    
        // Create the income with the logged-in user's ID
        $income = Income::create([
            'user_id' => auth()->id(),  // Set the user_id to the currently authenticated user's ID
            'source' => $request->source,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);
        
     // Redirect to a success page or wherever you need
     return redirect()->route('incomes.index');
    }    

    public function show($id)
    {
        $income = Income::findOrFail($id);
        return response()->json($income);
    }

    public function edit($id)
    {
        $income = Income::findOrFail($id);
        return view('income.edit', compact('income'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'source' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'date' => 'nullable|date',
        ]);

        $income = Income::findOrFail($id);
        $income->update($request->all());

        // Redirect to a success page or wherever you need
        return redirect()->route('incomes.index');
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();
    
        return response()->json(['success' => true]);
    }    
}
