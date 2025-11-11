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
            'nama_merek' => 'required|string',
        ]);

        $merek = Merek::create($validated);
        return response()->json($merek, 201);
    }

    public function update(Request $request, Merek $merek)
    {
        $validated = $request->validate([
            'nama_merek' => 'sometimes|required|string',
        ]);

        $merek->update($validated);
        return response()->json($merek);
    }

    public function destroy(Merek $merek)
    {
        $merek->delete();
        return response()->json(null, 204);
    }
}
