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
        return view('artists.create');
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
    public function store(ArtistRequest $request)
    {
        Artist::create($request->validated());
        return redirect()->route('artist.index')
            ->with('ok', __('Artist has been saved'));
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
    public function update(ArtistRequest $request, Artist $artist)
    {
        $artist->update( $request->validated() );

        return redirect()->route('artist.index')
            ->with( 'ok', __('Artist has been updated') );
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
