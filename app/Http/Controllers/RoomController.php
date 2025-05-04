<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{



    // 1) Lister
    public function index()
    {
        $rooms = Room::with('cinema')->get();
        return view('room.index', compact('rooms'));
    }

    // 2) Formulaire de création
    public function create()
    {
        return view('room.create');
    }

    // 3) Enregistrer
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'capacity'  => 'required|integer|min:1',
            'cinema_id' => 'required|exists:cinemas,id',
        ]);

        // 🔑  Associer la salle au créateur
        $validated['user_id'] = $request->user()->id;

        Room::create($validated);

        return redirect()
            ->route('room.index')
            ->with('success', 'Salle créée avec succès !');
    }

    // 4) Afficher
    public function show(Room $room)
    {
        // Récupérer les séances à venir (date future)
        $upcomingShowtimes = $room->showtimes()
            ->where('start_time', '>=', now())
            ->orderBy('start_time')
            ->get();

        // Récupérer les séances passées (date passée)
        $pastShowtimes = $room->showtimes()
            ->where('start_time', '<', now())
            ->orderBy('start_time', 'desc')
            ->get();

        return view('room.show', compact('room', 'upcomingShowtimes', 'pastShowtimes'));
    }

    // 5) Formulaire d’édition
    public function edit(Room $room)
    {
        return view('room.edit', compact('room'));
    }

    // 6) Mettre à jour
    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'capacity'  => 'required|integer|min:1',
            'cinema_id' => 'required|exists:cinemas,id',
        ]);

        // (optionnel) changer de propriétaire
        // $validated['user_id'] = $request->user()->id;

        $room->update($validated);

        return redirect()
            ->route('room.show', $room)
            ->with('success', 'Salle mise à jour !');
    }

    // 7) Supprimer
    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()
            ->route('room.index')
            ->with('success', 'Salle supprimée.');
    }
}
