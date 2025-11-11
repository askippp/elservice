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
            'nama_lengkap' => 'required|string',
            'id_user' => 'required|integer|exists:user,id',
            'id_cabang' => 'required|integer|exists:cabang,id',
        ]);

        $teknisi = Teknisi::create($validated);
        return response()->json($teknisi, 201);
    }

    public function update(Request $request, Teknisi $teknisi)
    {
        $validated = $request->validate([
            'email' => 'sometimes|required|email',
            'no_telp' => 'sometimes|required|string',
            'nama_lengkap' => 'sometimes|required|string',
            'id_user' => 'sometimes|required|integer|exists:user,id',
            'id_cabang' => 'sometimes|required|integer|exists:cabang,id',
        ]);

        $teknisi->update($validated);
        return response()->json($teknisi);
    }

    public function destroy(Teknisi $teknisi)
    {
        $teknisi->delete();
        return response()->json(null, 204);
    }
}
