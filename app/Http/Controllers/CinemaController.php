<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    public function index()
    {
        $cinemas = Cinema::with('rooms')->get();
        return view('cinema.index', compact('cinemas'));
    }

    public function create()
    {
        return view('cinema.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Cinema::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        Cinema::create($validated);

        return redirect()->route('cinema.index')
            ->with('success', 'Le cinéma a été créé avec succès');
    }

    public function edit(Cinema $cinema)
    {
        $this->authorize('update', $cinema);

        return view('cinema.edit', compact('cinema'));
    }

    public function update(Request $request, Cinema $cinema)
    {
        $this->authorize('update', $cinema);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $cinema->update($validated);

        return redirect()->route('cinema.index')
            ->with('success', 'Le cinéma a été modifié avec succès');
    }

    public function show(Cinema $cinema)
    {
        $this->authorize('view', $cinema);

        return view('cinema.show', compact('cinema'));
    }


    public function destroy(Cinema $cinema)
    {
        $this->authorize('delete', $cinema);

        // Supprimer les séances liées aux salles du cinéma
        foreach ($cinema->rooms as $room) {
            $room->showtimes()->delete();
        }

        // Supprimer les salles liées au cinéma
        $cinema->rooms()->delete();

        // Supprimer le cinéma
        $cinema->delete();

        return redirect()->route('cinema.index')
            ->with('success', 'Le cinéma a été supprimé avec succès');
    }
}
