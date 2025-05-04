<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CinemaController;


Route::get('/', function () {
    return view('welcome');
})->middleware('auth')->name('welcome');


// Route middleware pour les utilisateurs authentifiés et le rest c'est les routes publiques qui n'ont pas besoin d'authentification
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Routes pour Artist
    Route::resource('artist', ArtistController::class)->except(['destroy']);
    Route::delete('artist/{artist}', [ArtistController::class, 'destroy'])
        ->name('artist.destroy')
        ->middleware('auth');

    // Routes pour Country
    Route::resource('country', CountryController::class);
    Route::delete('country/{country}', [CountryController::class, 'destroy'])
        ->middleware('ajax')
        ->name('country.destroy');

    // Routes pour Film
    Route::resource('film', FilmController::class);
    Route::delete('film/{film}', [FilmController::class, 'destroy'])->name('film.destroy');

    // Routes pour ajouter un film à un artiste
    Route::get('artist/{artist}/add-movie', [ArtistController::class, 'addMovie'])
        ->name('artist.add-movie');
    Route::post('artist/{artist}/add-movie', [ArtistController::class, 'storeMovie'])
        ->name('artist.store-movie');

    //Route pour le cinema
    Route::resource('cinema', CinemaController::class);

    Route::get('/room', [App\Http\Controllers\RoomController::class, 'index'])->name('room.index');
    Route::get('/room/create', [App\Http\Controllers\RoomController::class, 'create'])->name('room.create');
    Route::post('/room', [App\Http\Controllers\RoomController::class, 'store'])->name('room.store');
    Route::get('/room/{room}/edit', [App\Http\Controllers\RoomController::class, 'edit'])->name('room.edit');
    Route::put('/room/{room}', [App\Http\Controllers\RoomController::class, 'update'])->name('room.update');
    Route::delete('/room/{room}', [App\Http\Controllers\RoomController::class, 'destroy'])->name('room.destroy');
});




