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
        // Récupérer tous les films avec leurs relations
        $films = Movie::with(['country', 'director', 'actors'])->get();

        // Vérifier si l'utilisateur est authentifié
        $auth_id = auth()->id();

        // Retourner la vue avec les films
        return view('film.index', [
            'films' => $films
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer',
            'country_id' => 'required|exists:countries,id',
            'director_id' => 'required|exists:artists,id',
            'poster_url' => 'nullable|url'
        ]);

        // Ajouter l'ID de l'utilisateur connecté
        $validated['user_id'] = auth()->id();

        Movie::create($validated);

        return redirect()->route('film.index')
            ->with('success', 'Le film a été créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $film)
    {
        $this->authorize('view', $film);

        // Charger les relations nécessaires
        $film->load(['country', 'director', 'actors']);

        // Récupérer l'artiste (réalisateur) associé
        $artist = $film->director;

        return view('film.show', compact('film', 'artist'));
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
    public function update(User $user, Movie $film): bool
    {
        // Si le film n'a pas de user_id et que l'utilisateur est authentifié
        if ($film->user_id === null && auth()->check()) {
            return true;
        }

        // Sinon vérifier si l'utilisateur est le propriétaire
        return $user->id === $film->user_id;
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
