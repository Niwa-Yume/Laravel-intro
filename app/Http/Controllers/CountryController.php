<?php

namespace App\Http\Controllers;
use App\Http\Requests\CountryRequest;
use App\Http\Requests\FilmRequest;
use App\Models\Movie;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('country.index', [ 'countries' => Country::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        Country::create($request->validated());
        return redirect()->route('country.index')
            ->with('ok', __('Le pays a été enregistré'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return view('country.show', compact('country'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view('country.edit', [
            'country' => $country,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        $country->update($request->validated());
        return redirect()->route('country.index')
            ->with('ok', __('Le pays a été modifié'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return response()->json();
    }
}
