<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Room;
use App\Models\Showtime;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function index()
    {
        $showtimes = Showtime::with(['movie', 'room.cinema'])->get();
        return view('showtime.index', compact('showtimes'));
    }

    public function create()
    {
        $this->authorize('create', Showtime::class);

        $movies = Movie::all();
        $rooms = Room::with('cinema')->get();

        return view('showtime.create', compact('movies', 'rooms'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Showtime::class);

        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after:now',
        ]);

        $validated['user_id'] = auth()->id();

        Showtime::create($validated);

        return redirect()->route('showtime.index')
            ->with('success', 'La séance a été créée avec succès');
    }

    public function show(Showtime $showtime)
    {
        $showtime->load(['movie', 'room.cinema']);
        return view('showtime.show', compact('showtime'));
    }

    public function edit(Showtime $showtime)
    {
        $this->authorize('update', $showtime);

        $movies = Movie::all();
        $rooms = Room::with('cinema')->get();

        return view('showtime.edit', compact('showtime', 'movies', 'rooms'));
    }

    public function update(Request $request, Showtime $showtime)
    {
        $this->authorize('update', $showtime);

        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after:now',
        ]);

        $showtime->update($validated);

        return redirect()->route('showtime.show', $showtime)
            ->with('success', 'La séance a été mise à jour avec succès');
    }

    public function destroy(Showtime $showtime)
    {
        $this->authorize('delete', $showtime);

        $showtime->delete();

        return redirect()->route('showtime.index')
            ->with('success', 'La séance a été supprimée avec succès');
    }
}
