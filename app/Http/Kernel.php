<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        // ... autres middlewares
        'ajax' => \App\Http\Middleware\Ajax::class,
    ];

    // ... reste de la classe
}
