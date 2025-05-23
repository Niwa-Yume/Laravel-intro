<?php

namespace App\Http\Controllers;
use App\Http\Requests\ArtistRequest;
use App\Models\Movie;
use App\Models\Artist;
use App\Models\Country;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('artists.index', ['artists' => Artist::with('movies')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artists.create', [
            'countries' => Country::all(),
            'movies' => Movie::all()
        ]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
        return view('artists.show', compact('artist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Artist::class);
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'firstname' => 'required|string|max:255',
                'country_id' => 'required|exists:countries,id',
                'description' => 'nullable|string',
                'image' => 'nullable|string|url',
                'movies' => 'nullable|array',
                'movies.*.movie_id' => 'required|exists:movies,id',
                'movies.*.role_name' => 'required|string|max:255'
            ]);

            // Ajout explicite du user_id
            $artist = Artist::create([
                'name' => $validatedData['name'],
                'firstname' => $validatedData['firstname'],
                'country_id' => $validatedData['country_id'],
                'description' => $validatedData['description'] ?? null,
                'image_path' => $validatedData['image'] ?? null,
                'user_id' => auth()->id() // Ajout de l'ID de l'utilisateur connecté
            ]);

            $validatedData['user_id'] = auth()->id();

            $artist = Artist::create($validatedData);
            // Gestion des films associés
            if (isset($validatedData['movies'])) {
                foreach ($validatedData['movies'] as $movie) {
                    $artist->movies()->attach($movie['movie_id'], [
                        'role_name' => $movie['role_name']
                    ]);
                }
            }

            return redirect()->route('artist.index')
                ->with('success', 'Artiste créé avec succès');

        } catch (\Exception $e) {
            \Log::error('Erreur création artiste: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de la création de l\'artiste')
                ->withInput();
        }
    }

    /**
     * Vérifie si le contenu est une image valide
     */
    private function isImage($content)
    {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->buffer($content);
        return strpos($mimeType, 'image/') === 0;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        return view('artists.edit', [
            'artist' => $artist,
            'countries' => Country::all(),
            'movies' => Movie::all(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $this->authorize('update', $artist);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'movies' => 'nullable|array',
            'movies.*.movie_id' => 'required|exists:movies,id',
            'movies.*.role_name' => 'required|string|max:255'
        ]);

        if ($request->hasFile('image')) {
            if ($artist->image_path) {
                Storage::disk('public')->delete($artist->image_path);
            }
            $path = $request->file('image')->store('artists', 'public');
            $validatedData['image_path'] = $path;
        }

        $artist->update([
            'name' => $validatedData['name'],
            'firstname' => $validatedData['firstname'],
            'country_id' => $validatedData['country_id'],
            'description' => $validatedData['description'],
            'image_path' => $validatedData['image_path'] ?? $artist->image_path
        ]);

        // Mise à jour des films
        $artist->movies()->detach();
        if (isset($validatedData['movies'])) {
            foreach ($validatedData['movies'] as $movie) {
                $artist->movies()->attach($movie['movie_id'], [
                    'role_name' => $movie['role_name']
                ]);
            }
        }

        return redirect()->route('artist.index')
            ->with('success', 'Artiste modifié avec succès');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist, Request $request)
    {
        $this->authorize('delete', $artist);
        try {
            // Vérifiez d'abord les relations
            if ($artist->directedMovies()->count() > 0) {
                if ($request->wantsJson()) {
                    return response()->json(['error' => 'Impossible de supprimer cet artiste car il est lié à des films en tant que réalisateur.'], 422);
                }
                return redirect()->back()->with('error', 'Impossible de supprimer cet artiste car il est lié à des films en tant que réalisateur.');
            }

            if ($artist->image_path) {
                Storage::disk('public')->delete($artist->image_path);
            }

            // Détachez d'abord les films
            $artist->movies()->detach();

            // Puis supprimez l'artiste
            $artist->delete();

            if ($request->wantsJson()) {
                return response()->json(['message' => 'Artist deleted successfully']);
            }

            return redirect()->route('artist.index')->with('success', 'Artiste supprimé avec succès');
        } catch (\Exception $e) {
            \Log::error('Erreur de suppression d\'artiste: ' . $e->getMessage());

            if ($request->wantsJson()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }

            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression de l\'artiste.');
        }
    }


    public function addMovie(Artist $artist)
    {
        return view('artists.add-movie', [
            'artist' => $artist,
            'movies' => Movie::whereDoesntHave('actors', function ($query) use ($artist) {
                $query->where('artist_id', $artist->id);
            })->get()
        ]);
    }

    public function storeMovie(Request $request, Artist $artist)
    {
        $validatedData = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'role_name' => 'required|string|max:255'
        ]);

        $artist->movies()->attach($validatedData['movie_id'], [
            'role_name' => $validatedData['role_name']
        ]);

        return redirect()->route('artist.show', $artist)
            ->with('success', 'Film ajouté avec succès');
    }
}
