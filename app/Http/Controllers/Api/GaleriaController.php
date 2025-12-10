<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GaleriaKep;
use App\Models\Leny;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriaController extends Controller
{
    /**
     * Get all gallery images for a creature
     */
    public function index(string $lenyId)
    {
        $leny = Leny::findOrFail($lenyId);
        $kepek = $leny->galeriaKepek;

        return response()->json($kepek);
    }

    /**
     * Upload a new image to creature's gallery
     */
    public function store(Request $request, string $lenyId)
    {
        $leny = Leny::findOrFail($lenyId);

        $validated = $request->validate([
            'kep' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cim' => 'nullable|string|max:255',
            'leiras' => 'nullable|string',
        ]);

        if ($request->hasFile('kep')) {
            $file = $request->file('kep');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('galeria', $filename, 'public');

            $galeriaKep = GaleriaKep::create([
                'leny_id' => $leny->id,
                'kep_url' => '/storage/' . $path,
                'cim' => $validated['cim'] ?? null,
                'leiras' => $validated['leiras'] ?? null,
            ]);

            return response()->json([
                'kep' => $galeriaKep,
                'message' => 'Kép sikeresen feltöltve!'
            ], 201);
        }

        return response()->json(['message' => 'Kép feltöltése sikertelen!'], 400);
    }

    /**
     * Delete an image from gallery
     */
    public function destroy(string $lenyId, string $kepId)
    {
        $kep = GaleriaKep::where('leny_id', $lenyId)
                         ->where('id', $kepId)
                         ->firstOrFail();

        // Töröljük a fájlt is a storage-ból
        $filepath = str_replace('/storage/', '', $kep->kep_url);
        Storage::disk('public')->delete($filepath);

        $kep->delete();

        return response()->json([
            'message' => 'Kép sikeresen törölve!'
        ]);
    }
}
