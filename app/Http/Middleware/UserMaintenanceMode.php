<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        if (setting('User_maintenance_mode') == 1) {
            abort(503, 'User panel under maintenance');
        }
        return $next($request);
    }
}
