<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\CountryController;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('artist', ArtistController::class);
Route::delete('artist/{artist}', [ArtistController::class, 'destroy'])
    ->middleware('ajax')
    ->name('artist.destroy');

Route::resource('film', FilmController::class);
Route::resource('country', CountryController::class);
Route::delete('country/{country}', [CountryController::class, 'destroy'])
    ->middleware('ajax')
    ->name('country.destroy');
