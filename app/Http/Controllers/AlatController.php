<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        return response()->json(Alat::all());
    }

    public function show(Alat $alat)
    {
        return response()->json($alat);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|integer|exists:kategori,id',
            'id_merek' => 'required|integer|exists:merek,id',
            'nama_alat' => 'required|string',
            'tipe_model' => 'required|string',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|string',
            'status' => 'required|string',
        ]);

        $alat = Alat::create($validated);
        return response()->json([
            'message' => 'Alat created successfully',
            'data' => $alat
        ], 201);
    }

    public function update(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'id_kategori' => 'sometimes|required|integer|exists:kategori,id',
            'id_merek' => 'sometimes|required|integer|exists:merek,id',
            'nama_alat' => 'sometimes|required|string',
            'tipe_model' => 'sometimes|required|string',
            'deskripsi' => 'sometimes|required|string',
            'foto' => 'nullable|string',
            'status' => 'sometimes|required|string',
        ]);

        $alat->update($validated);
        return response()->json([
            'message' => 'Alat updated successfully',
            'data' => $alat
        ]);
    }

    public function destroy(Alat $alat)
    {
        $alat->delete();
        return response()->json([
            'message' => 'Alat deleted successfully'
        ], 200);
    }
}
