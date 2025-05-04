<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Http\Requests\CinemaRequest;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    /**
     * Affiche la liste des cinémas
     */
    public function index()
    {
        $cinemas = Cinema::with('rooms')->get();
        return view('cinema.index', compact('cinemas'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('cinema.create');
    }

    /**
     * Enregistre un nouveau cinéma
     */
    public function store(CinemaRequest $request)
    {
        $cinema = Cinema::create($request->validated());
        return redirect()->route('cinema.show', $cinema->id)
            ->with('success', 'Cinéma créé avec succès');
    }

    /**
     * Affiche un cinéma spécifique
     */
    public function show(Cinema $cinema)
    {
        $cinema->load('rooms.showtimes.movie');
        return view('cinema.show', compact('cinema'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Cinema $cinema)
    {
        $cinema->load('rooms');
        return view('cinema.edit', compact('cinema'));
    }

    /**
     * Met à jour un cinéma existant
     */
    public function update(CinemaRequest $request, Cinema $cinema)
    {
        // Mise à jour des données validées uniquement
        $cinema->update($request->validated());

        return redirect()->route('cinema.show', $cinema->id)
            ->with('success', 'Cinéma modifié avec succès');
    }

    /**
     * Supprime un cinéma
     */
    public function destroy(Cinema $cinema)
    {
        // Supprime d'abord les salles associées (et leurs séances)
        foreach ($cinema->rooms as $room) {
            if ($room->showtimes) {
                $room->showtimes()->delete();
            }
            $room->delete();
        }

        // Puis supprime le cinéma
        $cinema->delete();

        return redirect()->route('cinema.index')
            ->with('success', 'Cinéma et ses salles supprimés avec succès');
    }
}
