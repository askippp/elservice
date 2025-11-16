<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use Illuminate\Http\Request;

class TeknisiController extends Controller
{
    public function index()
    {
        return response()->json(Teknisi::all());
    }

    public function show(Teknisi $teknisi)
    {
        return response()->json($teknisi);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'no_telp' => 'required|string',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'spesialisasi' => 'required|string',
            'foto' => 'nullable|string',
            'id_cabang' => 'required|integer|exists:cabang,id',
        ]);

        $teknisi = Teknisi::create($validated);
        return response()->json([
            'message' => 'Teknisi created successfully',
            'teknisi' => $teknisi,
        ], 201);
    }

    public function update(Request $request, Teknisi $teknisi)
    {
        $validated = $request->validate([
            'email' => 'sometimes|required|email',
            'no_telp' => 'sometimes|required|string',
            'nama' => 'sometimes|required|string',
            'alamat' => 'sometimes|required|string',
            'spesialisasi' => 'sometimes|required|string',
            'foto' => 'sometimes|nullable|string',
            'id_cabang' => 'sometimes|required|integer|exists:cabang,id',
        ]);

        $teknisi->update($validated);
        return response()->json([
            'message' => 'Teknisi updated successfully',
            'teknisi' => $teknisi,
        ]);
    }

    public function destroy(Teknisi $teknisi)
    {
        $teknisi->delete();
        return response()->json([
            'message' => 'Teknisi deleted successfully',
        ], 200);
    }
}
