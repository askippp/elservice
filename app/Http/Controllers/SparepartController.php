<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    public function index()
    {
        return response()->json(Sparepart::all());
    }

    public function show(Sparepart $sparepart)
    {
        return response()->json($sparepart);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_kategori' => 'required|integer|exists:kategori,id',
            'id_merek' => 'required|integer|exists:merek,id',
            'nama_sparepart' => 'required|string',
            'satuan' => 'required|string',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'stok' => 'required|integer',
            'foto' => 'nullable|string',
        ]);

        $sparepart = Sparepart::create($validated);
        return response()->json($sparepart, 201);
    }

    public function update(Request $request, Sparepart $sparepart)
    {
        $validated = $request->validate([
            'id_kategori' => 'sometimes|required|integer|exists:kategori,id',
            'id_merek' => 'sometimes|required|integer|exists:merek,id',
            'nama_sparepart' => 'sometimes|required|string',
            'satuan' => 'sometimes|required|string',
            'harga_beli' => 'sometimes|required|integer',
            'harga_jual' => 'sometimes|required|integer',
            'stok' => 'sometimes|required|integer',
            'foto' => 'nullable|string',
        ]);

        $sparepart->update($validated);
        return response()->json($sparepart);
    }

    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();
        return response()->json(null, 204);
    }
}
