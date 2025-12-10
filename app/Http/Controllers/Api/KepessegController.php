<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kepesseg;
use Illuminate\Http\Request;

class KepessegController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kepessegek = Kepesseg::all();
        return response()->json($kepessegek);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nev' => 'required|string|max:255',
            'leiras' => 'nullable|string',
            'tipus' => 'required|in:fizikai,magikus,mentalis,egyeb',
        ]);

        $kepesseg = Kepesseg::create($validated);

        return response()->json([
            'kepesseg' => $kepesseg,
            'message' => 'Képesség sikeresen létrehozva!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kepesseg = Kepesseg::with('lenyek')->findOrFail($id);
        return response()->json($kepesseg);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kepesseg = Kepesseg::findOrFail($id);

        $validated = $request->validate([
            'nev' => 'sometimes|required|string|max:255',
            'leiras' => 'nullable|string',
            'tipus' => 'sometimes|required|in:fizikai,magikus,mentalis,egyeb',
        ]);

        $kepesseg->update($validated);

        return response()->json([
            'kepesseg' => $kepesseg,
            'message' => 'Képesség sikeresen frissítve!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kepesseg = Kepesseg::findOrFail($id);
        $kepesseg->delete();

        return response()->json([
            'message' => 'Képesség sikeresen törölve!'
        ]);
    }
}
