<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Leny;
use Illuminate\Http\Request;

class LenyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lenyek = Leny::with(['kategoria', 'kepessegek', 'galeriaKepek', 'user'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($lenyek);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nev' => 'required|string|max:255',
            'leiras' => 'required|string',
            'eredet' => 'nullable|string|max:255',
            'ritka_sag_szint' => 'required|integer|min:1|max:10',
            'kategoria_id' => 'required|exists:kategorias,id',
        ]);

        $validated['user_id'] = $request->user()->id;
        $validated['aktiv'] = true;

        $leny = Leny::create($validated);

        return response()->json([
            'leny' => $leny->load(['kategoria', 'user']),
            'message' => 'Lény sikeresen létrehozva!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leny = Leny::with(['kategoria', 'kepessegek', 'galeriaKepek', 'user'])->findOrFail($id);
        return response()->json($leny);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $leny = Leny::findOrFail($id);

        // Ellenőrizzük, hogy a user tulajdonosa-e a lénynek
        if ($leny->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Nincs jogosultságod ehhez a művelethez.'], 403);
        }

        $validated = $request->validate([
            'nev' => 'sometimes|required|string|max:255',
            'leiras' => 'sometimes|required|string',
            'eredet' => 'nullable|string|max:255',
            'ritka_sag_szint' => 'sometimes|required|integer|min:1|max:10',
            'kategoria_id' => 'sometimes|required|exists:kategorias,id',
            'aktiv' => 'sometimes|boolean',
        ]);

        $leny->update($validated);

        return response()->json([
            'leny' => $leny->load(['kategoria', 'kepessegek', 'galeriaKepek']),
            'message' => 'Lény sikeresen frissítve!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leny = Leny::findOrFail($id);

        // Ellenőrizzük, hogy a user tulajdonosa-e a lénynek
        if ($leny->user_id !== request()->user()->id) {
            return response()->json(['message' => 'Nincs jogosultságod ehhez a művelethez.'], 403);
        }

        $leny->delete();

        return response()->json([
            'message' => 'Lény sikeresen törölve!'
        ]);
    }

    /**
     * Attach ability to creature
     */
    public function attachKepesseg(Request $request, string $id)
    {
        $leny = Leny::findOrFail($id);

        $validated = $request->validate([
            'kepesseg_id' => 'required|exists:kepessegs,id',
            'szint' => 'required|integer|min:1|max:10',
        ]);

        $leny->kepessegek()->attach($validated['kepesseg_id'], ['szint' => $validated['szint']]);

        return response()->json([
            'leny' => $leny->load('kepessegek'),
            'message' => 'Képesség sikeresen hozzáadva!'
        ]);
    }

    /**
     * Detach ability from creature
     */
    public function detachKepesseg(string $lenyId, string $kepessegId)
    {
        $leny = Leny::findOrFail($lenyId);
        $leny->kepessegek()->detach($kepessegId);

        return response()->json([
            'leny' => $leny->load('kepessegek'),
            'message' => 'Képesség sikeresen eltávolítva!'
        ]);
    }
}
