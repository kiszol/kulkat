<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategoria;
use Illuminate\Http\Request;

class KategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoriak = Kategoria::withCount('lenyek')->get();
        return response()->json($kategoriak);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nev' => 'required|string|max:255|unique:kategorias',
            'leiras' => 'nullable|string',
        ]);

        $kategoria = Kategoria::create($validated);

        return response()->json([
            'kategoria' => $kategoria,
            'message' => 'Kategória sikeresen létrehozva!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategoria = Kategoria::with('lenyek')->findOrFail($id);
        return response()->json($kategoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategoria = Kategoria::findOrFail($id);

        $validated = $request->validate([
            'nev' => 'sometimes|required|string|max:255|unique:kategorias,nev,' . $id,
            'leiras' => 'nullable|string',
        ]);

        $kategoria->update($validated);

        return response()->json([
            'kategoria' => $kategoria,
            'message' => 'Kategória sikeresen frissítve!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategoria = Kategoria::findOrFail($id);
        $kategoria->delete();

        return response()->json([
            'message' => 'Kategória sikeresen törölve!'
        ]);
    }
}
