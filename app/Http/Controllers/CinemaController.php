<?php

namespace App\Http\Controllers;

use App\Http\Requests\CinemaRequest;
use App\Models\Cinema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CinemaController extends Controller
{
    public function index()
    {
        return view('cinema.index', [
            'cinemas' => Cinema::with('rooms')->get()
        ]);
    }

    public function create()
    {
        return view('cinema.create');
    }

    public function store(CinemaRequest $request)
    {
        $cinema = Cinema::create($request->validated());

        return redirect()->route('cinema.index')
            ->with('success', __('Le cinéma a été créé avec succès'));
    }

    public function show(Cinema $cinema)
    {
        $cinema->load(['rooms.showtimes.movie']);
        return view('cinema.show', compact('cinema'));
    }

    public function edit(Cinema $cinema)
    {
        return view('cinema.edit', compact('cinema'));
    }

    public function update(CinemaRequest $request, Cinema $cinema)
    {
        $cinema->update($request->validated());

        return redirect()->route('cinema.index')
            ->with('success', __('Le cinéma a été modifié avec succès'));
    }

    public function destroy(Cinema $cinema)
    {
        try {
            DB::beginTransaction();

            // Supprimer les séances associées à chaque salle
            foreach ($cinema->rooms as $room) {
                $room->showtimes()->delete();
            }

            // Supprimer les salles
            $cinema->rooms()->delete();

            // Supprimer le cinéma
            $cinema->delete();

            DB::commit();

            return redirect()->route('cinema.index')
                ->with('success', __('Le cinéma a été supprimé avec succès'));

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->with('error', __('Une erreur est survenue lors de la suppression du cinéma'));
        }
    }
}
