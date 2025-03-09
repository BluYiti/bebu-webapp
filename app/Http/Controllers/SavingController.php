<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;

class SavingController extends Controller
{
    public function index()
    {
        $Saving = Saving::all();
        return response()->json($Saving);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'goal_amount' => 'required|numeric',
            'current_amount' => 'required|numeric',
            'target_date' => 'nullable|date',
        ]);

        $saving = Saving::create($request->all());
        return response()->json($saving, 201);
    }

    public function show($id)
    {
        $saving = Saving::findOrFail($id);
        return response()->json($saving);
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

        return response()->json($saving);
    }

    public function destroy($id)
    {
        $saving = Saving::findOrFail($id);
        $saving->delete();

        return response()->json(null, 204);
    }
}
