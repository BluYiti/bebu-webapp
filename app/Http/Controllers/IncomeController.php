<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::all();
        return response()->json($incomes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'source' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $income = Income::create($request->all());
        return response()->json($income, 201);
    }

    public function show($id)
    {
        $income = Income::findOrFail($id);
        return response()->json($income);
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

        return response()->json($income);
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();

        return response()->json(null, 204);
    }
}
