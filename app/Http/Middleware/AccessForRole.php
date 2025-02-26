<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use TiMacDonald\Middleware\HasParameters;

class AccessForRole
{
    use HasParameters;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (Auth::user()->role == 'SUPER_ADMIN') {
            return $next($request);
        } elseif (!in_array(Auth::user()->role, $roles)) {
            abort(403);
        }
        return $next($request);
    }
}
