<?php

namespace App\Http\Controllers;
use App\Http\Requests\ArtistRequest;
use App\Models\Artist;
use App\Models\Country;
use App\Models\Label;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //permet de faire du debuggin
        // return dd($artists = Artist::all());
        return view('artists.index', [ 'artists' => Artist::all() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('artists.create', [
            'countries' => Country::all()
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('artists', 'public');
            $validatedData['image_path'] = $path;
        }

        Artist::create($validatedData);

        return redirect()->route('artist.index')
            ->with('success', 'Artiste créé avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        return view('artists.edit', ['artist' => $artist, 'countries' => Country::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($artist->image_path) {
                Storage::disk('public')->delete($artist->image_path);
            }
            $path = $request->file('image')->store('artists', 'public');
            $validatedData['image_path'] = $path;
        }

        $artist->update($validatedData);

        return redirect()->route('artist.index')
            ->with('success', 'Artiste modifié avec succès');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return response()->json();
    }
}
