<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Ajax
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->ajax()) {
            abort(403);
        }

        return $next($request);
    }
}
