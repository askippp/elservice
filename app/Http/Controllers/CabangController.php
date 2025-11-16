<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use Illuminate\Http\Request;

class CabangController extends Controller
{
    public function index()
    {
        return response()->json(Cabang::all());
    }

    public function show(Cabang $cabang)
    {
        return response()->json($cabang);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_cabang' => 'required|string',
            'no_telp' => 'required|integer',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'email' => 'required|email',
            'foto' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $cabang = Cabang::create($validated);
        return response()->json([
            'message' => 'Cabang created successfully',
            'cabang' => $cabang,
        ], 201);
    }

    public function update(Request $request, Cabang $cabang)
    {
        $validated = $request->validate([
            'nama_cabang' => 'sometimes|required|string',
            'no_telp' => 'sometimes|required|integer',
            'alamat' => 'sometimes|required|string',
            'kota' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'foto' => 'nullable|string',
            'status' => 'sometimes|required|string',
        ]);

        $cabang->update($validated);
        return response()->json([
            'message' => 'Cabang updated successfully',
            'cabang' => $cabang,
        ], 200);
    }

    public function destroy(Cabang $cabang)
    {
        $cabang->delete();
        return response()->json([
            'message' => 'Cabang deleted successfully',
        ], 200);
    }
}
