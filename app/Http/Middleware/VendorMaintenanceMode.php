<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VendorMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        if (setting('vendor_maintenance_mode') == 1) {
            abort(503, 'Vendor panel under maintenance');
        }
        return $next($request);
    }
}
