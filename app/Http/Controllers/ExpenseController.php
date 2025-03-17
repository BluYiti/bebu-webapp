<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Budget;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all(); // Fetch all expenses
        return view('expenses.index', compact('expenses'));
    }

    public function create()
    {
        // Fetch all unique categories from the budgets table
        $categories = Budget::distinct()->pluck('category'); 
    
        // Set the selected budget id, for example, the first budget in the list
        $selectedBudgetId = Budget::first()->id; // Modify this logic based on your needs
        
        // Pass categories and selectedBudgetId to the view
        return view('expenses.create', compact('categories', 'selectedBudgetId'));
    }    

    public function store(Request $request)
    {
        // Validate the input fields
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'quantity' => 'required|integer|min:1',
            'category' => 'required|string',
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'budget_id' => 'required|exists:budgets,id',
            'notes' => 'nullable|string|max:255',  // Validate notes as a string (if required)
        ]);        
    
        // Calculate the total amount
        $totalAmount = $validatedData['amount'] * $validatedData['quantity'];
    
        // Save the expense with the total amount
        Expense::create([
            'user_id' => $validatedData['user_id'],
            'amount' => $validatedData['amount'],
            'quantity' => $validatedData['quantity'],
            'category' => $validatedData['category'],
            'date' => $validatedData['date'],
            'notes' => $validatedData['notes'] ?? null,
            'budget_id' => $validatedData['budget_id'],
            'total_amount' => $totalAmount, // Store the calculated total amount
        ]);
        
        // Redirect to a success page or wherever you need
        return redirect()->route('expenses.index');
    }      

    public function show($id)
    {
        $expense = Expense::findOrFail($id);
        return response()->json($expense);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request for updating the expense
        $request->validate([
            'category' => 'nullable|string',
            'amount' => 'nullable|numeric',
            'quantity' => 'nullable|integer|min:1', // Ensure quantity is valid when updating
            'date' => 'nullable|date',
        ]);

        $expense = Expense::findOrFail($id);
        // Update the expense, including the quantity if provided
        $expense->update($request->only(['category', 'amount', 'quantity', 'date', 'notes']));

        return response()->json($expense);
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();
    
        // Return a JSON response for AJAX
        return response()->json(['success' => true]);
    }    
}
