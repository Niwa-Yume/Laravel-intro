<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use App\Models\Movie;
use App\Models\Room;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function index()
    {
        // Récupérer toutes les séances avec leurs relations
        $showtimes = Showtime::with(['movie', 'room.cinema'])
            ->orderBy('start_time')
            ->get();

        return view('showtime.index', compact('showtimes'));
    }
    public function create()
    {
        $movies = Movie::all();
        $rooms = Room::with('cinema')->get();
        return view('showtime.create', compact('movies', 'rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after:now',
        ]);

        Showtime::create($validated);

        return redirect()->route('showtime.index')
            ->with('success', 'La séance a été créée avec succès');
    }

    public function edit(Showtime $showtime)
    {
        $movies = Movie::all();
        $rooms = Room::with('cinema')->get();
        return view('showtime.edit', compact('showtime', 'movies', 'rooms'));
    }

    public function update(Request $request, Showtime $showtime)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
        ]);

        $showtime->update($validated);

        return redirect()->route('showtime.index')
            ->with('success', 'La séance a été modifiée avec succès');
    }

    public function show(Showtime $showtime)
    {
        return view('showtime.show', compact('showtime'));
    }

    public function destroy(Showtime $showtime)
    {
        $showtime->delete();

        return redirect()->route('showtime.index')
            ->with('success', 'La séance a été supprimée avec succès');
    }
}
