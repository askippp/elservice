<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        return response()->json(Kategori::all());
    }

    public function show(Kategori $kategori)
    {
        return response()->json($kategori);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|unique:kategori,nama_kategori',
            'deskripsi' => 'required|string'
        ]);

        $kategori = Kategori::create($validated);
        return response()->json([
            'message' => 'Kategori created successfully',
            'data' => $kategori
        ], 201);
    }

    public function update(Request $request, Kategori $kategori)
    {
        $validated = $request->validate([
            'nama_kategori' => 'sometimes|required|string|unique:kategori,nama_kategori',
            'deskripsi' => 'sometimes|required|string'
        ]);

        $kategori->update($validated);
        return response()->json([
            'message' => 'Kategori updated successfully',
            'data' => $kategori
        ]);
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return response()->json([
            'message' => 'Kategori deleted successfully',
            'data' => $kategori
        ], 200);
    }
}
