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

        // Ajouter les autres acteurs avec un rôle par défaut
        if ($request->has('actors')) {
            $actorsWithRole = collect($request->actors)->mapWithKeys(function ($actorId) {
                return [$actorId => ['role_name' => 'Acteur']];
            })->toArray();

            $film->actors()->attach($actorsWithRole);
        }

        return redirect()->route('film.index')
            ->with('success', __('Le film a été enregistré'));
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

        return redirect()->route('film.index')
            ->with('ok', __('Le film a été modifié'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $film)
    {
        $film->delete();
        return response()->json();
    }
}
