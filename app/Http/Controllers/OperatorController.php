<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    public function index()
    {
        return response()->json(Operator::all());
    }

    public function show(Operator $operator)
    {
        return response()->json($operator);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'no_telp' => 'required|string',
            'nama_lengkap' => 'required|string',
            'id_user' => 'required|integer|exists:user,id',
            'id_cabang' => 'required|integer|exists:cabang,id',
        ]);

        $operator = Operator::create($validated);
        return response()->json($operator, 201);
    }

    public function update(Request $request, Operator $operator)
    {
        $validated = $request->validate([
            'email' => 'sometimes|required|email',
            'no_telp' => 'sometimes|required|string',
            'nama_lengkap' => 'sometimes|required|string',
            'id_user' => 'sometimes|required|integer|exists:user,id',
            'id_cabang' => 'sometimes|required|integer|exists:cabang,id',
        ]);

        $operator->update($validated);
        return response()->json($operator);
    }

    public function destroy(Operator $operator)
    {
        $operator->delete();
        return response()->json(null, 204);
    }
}
