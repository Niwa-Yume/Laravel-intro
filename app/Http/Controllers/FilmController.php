<?php

namespace App\Http\Controllers;
use App\Http\Requests\FilmRequest;
use App\Models\Movie;
use App\Models\Artist;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


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
        $validatedData = $request->validated();
        $validatedData['user_id'] = auth()->id(); // Ajout de l'ID utilisateur

        // Créer le film
        $film = Movie::create($validatedData);

        // Gérer l'image si présente
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('films', 'public');
            $film->image_path = $path;
            $film->save();
        }

        // Ajouter le directeur
        if ($request->director_id) {
            $film->actors()->attach($request->director_id, ['role_name' => 'Directeur']);
        }

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

        $film->update($request->validated());
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
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('films', 'public');
            $film->image_path = $path;
            $film->save();
        }
        return redirect()->route('film.index')
            ->with('success', __('Le film a été modifié'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $film)
    {
        try {
            DB::beginTransaction();

            $film->actors()->detach();

            if ($film->image_path) {
                Storage::delete($film->image_path);
            }

            $film->delete();

            DB::commit();

            return redirect()->route('film.index')
                ->with('success', __('Le film a été supprimé avec succès'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', __('Une erreur est survenue lors de la suppression du film'));
        }
    }
}
