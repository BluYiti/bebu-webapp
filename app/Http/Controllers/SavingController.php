<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index()
    {
        $savings = Saving::all(); // Get all savings (for a single user setup)
        return view('savings.index', compact('savings'));
    }

    public function create()
    {
        return view('savings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'goal_amount' => 'required|numeric|min:0',
            'target_date' => 'nullable|date',
        ]);

        Saving::create($request->all());
        return redirect()->route('savings.index')->with('success', 'Savings goal added!');
    }

    public function edit(Saving $saving)
    {
        return view('savings.edit', compact('saving'));
    }

    public function update(Request $request, Saving $saving)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'goal_amount' => 'required|numeric|min:0',
            'current_amount' => 'required|numeric|min:0',
            'target_date' => 'nullable|date',
        ]);

        $saving->update($request->all());
        return redirect()->route('savings.index')->with('success', 'Savings updated!');
    }

    public function destroy(Saving $saving)
    {
        $saving->delete();
        return redirect()->route('savings.index')->with('success', 'Savings removed.');
    }
}
