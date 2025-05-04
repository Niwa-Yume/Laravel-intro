<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Cinema;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function create(Request $request)
    {
        $cinema_id = $request->query('cinema_id');
        $cinema = null;

        if ($cinema_id) {
            $cinema = Cinema::findOrFail($cinema_id);
        }

        return view('room.create', compact('cinema'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'cinema_id' => 'required|exists:cinemas,id',
        ]);

        Room::create($validated);

        return redirect()->route('cinema.edit', $validated['cinema_id'])
            ->with('success', 'La salle a été créée avec succès');
    }

    public function edit(Room $room)
    {
        return view('room.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $room->update($validated);

        return redirect()->route('cinema.edit', $room->cinema_id)
            ->with('success', 'La salle a été modifiée avec succès');
    }

    public function destroy(Room $room)
    {
        $cinema_id = $room->cinema_id;
        $room->showtimes()->delete();
        $room->delete();

        return redirect()->route('cinema.edit', $cinema_id)
            ->with('success', 'La salle a été supprimée avec succès');
    }
}
