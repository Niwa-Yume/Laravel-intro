<?php

namespace App\Http\Controllers;
use App\Http\Requests\FilmRequest;
use App\Models\Movie;
use App\Models\Artist;
use App\Models\Country;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('film.index', [
            'films' => Movie::with(['actors', 'country'])->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('film.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FilmRequest $request)
    {
        $film = Movie::create($request->validated());

        // Ajouter le directeur avec son rôle
        $film->actors()->attach($request->director_id, ['role_name' => 'Directeur']);

        // Ajouter le casting
        if ($request->has('casting')) {
            foreach ($request->casting as $castMember) {
                if (!empty($castMember['actor_id'])) {
                    $film->actors()->attach($castMember['actor_id'], [
                        'role_name' => 'Acteur'
                    ]);
                }
            }
        }

        return redirect()->route('film.index')
            ->with('success', __('Le film a été créé'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $film)
    {
        return view('film.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $film)
    {
        return view('film.edit', [
            'film' => $film,
            'countries' => Country::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FilmRequest $request, Movie $film)
    {
        $film->update($request->validated());

        // Supprimer tous les acteurs existants
        $film->actors()->detach();

        // Ajouter le directeur avec son rôle
        $film->actors()->attach($request->director_id, ['role_name' => 'Directeur']);

        // Ajouter ou mettre à jour le casting
        if ($request->has('casting')) {
            foreach ($request->casting as $castMember) {
                if (!empty($castMember['actor_id'])) {
                    $film->actors()->attach($castMember['actor_id'], [
                        'role_name' => 'Acteur'
                    ]);
                }
            }
        }

        return redirect()->route('film.index')
            ->with('success', __('Le film a été modifié'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $film)
    {
        // Détacher d'abord toutes les relations avec les artistes
        $film->actors()->detach();

        // Puis supprimer le film
        $film->delete();

        return redirect()->route('film.index')
            ->with('success', __('Le film a été supprimé'));
    }
}
