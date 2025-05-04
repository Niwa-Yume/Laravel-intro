<?php

namespace App\Providers;

use App\Models\Movie;
use App\Models\Artist;
use App\Models\Cinema;
use App\Models\Room;
use App\Models\Showtime;
use App\Policies\CinemaPolicy;
use App\Policies\RoomPolicy;
use App\Policies\ShowtimePolicy;
use App\Policies\MoviePolicy;
use App\Policies\ArtistPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Room::class => RoomPolicy::class,
        Showtime::class => ShowtimePolicy::class,
        Artist::class => ArtistPolicy::class,
        Movie::class => MoviePolicy::class,
        Cinema::class => CinemaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Vous pouvez laisser cette méthode vide ou y ajouter d'autres configurations d'autorisation
    }
}
