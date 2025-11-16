<?php

namespace App\Http\Controllers;

use App\Models\Merek;
use Illuminate\Http\Request;

class MerekController extends Controller
{
    public function index()
    {
        return response()->json(Merek::all());
    }

    public function show(Merek $merek)
    {
        return response()->json($merek);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_merek' => 'required|string|unique:merek,nama_merek',
            'negara_asal' => 'required|string'
        ]);

        $merek = Merek::create($validated);
        return response()->json([
            'message' => 'Merek created successfully',
            'data' => $merek
        ], 201);
    }

    public function update(Request $request, Merek $merek)
    {
        $validated = $request->validate([
            'nama_merek' => 'sometimes|required|string|unique:merek,nama_merek',
            'negara_asal' => 'sometimes|required|string'
        ]);

        $merek->update($validated);
        return response()->json([
            'message' => 'Merek updated successfully',
            'data' => $merek
        ]);
    }

    public function destroy(Merek $merek)
    {
        $merek->delete();
        return response()->json([
            'message' => 'Merek deleted successfully'
        ], 200);
    }
}
