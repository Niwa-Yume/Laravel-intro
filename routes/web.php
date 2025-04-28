<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\CountryController;

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


});




