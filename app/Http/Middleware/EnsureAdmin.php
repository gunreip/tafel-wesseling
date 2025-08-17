<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $u = $request->user();
        if (!$u || ($u->role ?? null) !== 'admin') {
            abort(403, 'Admin required.');
        }
        return $next($request);
    }
}
