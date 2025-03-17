<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index()
    {
        $savings = Saving::all();  // Get all savings
        return view('savings.index', compact('savings'));  // Pass savings to the view
    }    
    public function create()
    {
        return view('savings.create');
    }    

    public function store(Request $request)
    {
        \Log::info('SavingController@store called', $request->all()); // Debug log
    
        $request->validate([
            'title' => 'required|string',
            'goal_amount' => 'required|numeric',
        ]);
    
        $saving = Saving::create($request->all());
    
        return redirect()->route('savings.index')->with('success', 'Savings goal created successfully!');
    }    

    public function show($id)
    {
        $saving = Saving::findOrFail($id);
        return response()->json($saving);
    }

    public function storeDeposit(Request $request, $id)
    {
        $request->validate([
            'deposit_amount' => 'required|numeric|min:1',
        ]);
    
        $saving = Saving::findOrFail($id);
    
        // Update the current amount with the deposit
        $saving->current_amount += $request->deposit_amount;
        $saving->save();
    
        return redirect()->route('savings.index')->with('success', 'Deposit successful!');
    }    

    public function showDepositForm($id)
    {
        $saving = Saving::findOrFail($id);
        return view('savings.deposit', compact('saving'));
    }

    public function storeWithdraw(Request $request, $id)
    {
        $request->validate([
            'withdraw_amount' => 'required|numeric|min:1',
        ]);
    
        $saving = Saving::findOrFail($id);
        
        // Check if the withdraw amount is greater than the current amount
        if ($request->withdraw_amount > $saving->current_amount) {
            return redirect()->route('savings.withdraw', $saving->id)
                             ->withErrors(['withdraw_amount' => 'Insufficient funds.']);
        }
    
        // Update the current amount after withdrawal
        $saving->current_amount -= $request->withdraw_amount;
        $saving->save();
    
        return redirect()->route('savings.index')->with('success', 'Withdrawal successful!');
    }

    public function edit($id)
    {
        $saving = Saving::findOrFail($id); // Get the saving by ID
        return view('savings.edit', compact('saving')); // Pass the saving data to the view
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'nullable|string',
            'goal_amount' => 'nullable|numeric',
            'current_amount' => 'nullable|numeric',
            'target_date' => 'nullable|date',
        ]);

        $saving = Saving::findOrFail($id);
        $saving->update($request->all());

        return redirect()->route('savings.index')->with('success', 'Edit successful!');
    }

    public function destroy($id)
    {
        $saving = Saving::findOrFail($id);
        $saving->delete();

        return response()->json(null, 204);
    }

    public function complete($id)
    {
        $saving = Saving::find($id);
        $saving->status = 'completed'; // assuming you have a status field to mark completion
        $saving->save();

        return redirect()->route('savings.index')->with('success', 'Savings goal marked as complete.');
    }
}
