<?php

namespace App\Providers;

use App\Models\Showtime;
use App\Policies\ShowtimePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\Showtime::class => \App\Policies\ShowtimePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
