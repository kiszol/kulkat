<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KapcsolatiUzenet;
use Illuminate\Http\Request;

class KapcsolatController extends Controller
{
    /**
     * Store a new contact message
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nev' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'targy' => 'required|string|max:255',
            'uzenet' => 'required|string',
        ]);

        $uzenet = KapcsolatiUzenet::create($validated);

        return response()->json([
            'uzenet' => $uzenet,
            'message' => 'Üzenet sikeresen elküldve!'
        ], 201);
    }

    /**
     * Get all contact messages (admin only)
     */
    public function index()
    {
        $uzenetek = KapcsolatiUzenet::orderBy('created_at', 'desc')->get();
        return response()->json($uzenetek);
    }

    /**
     * Mark message as read
     */
    public function markAsRead(string $id)
    {
        $uzenet = KapcsolatiUzenet::findOrFail($id);
        $uzenet->update(['elolvasva' => true]);

        return response()->json([
            'uzenet' => $uzenet,
            'message' => 'Üzenet olvasottnak jelölve!'
        ]);
    }
}
