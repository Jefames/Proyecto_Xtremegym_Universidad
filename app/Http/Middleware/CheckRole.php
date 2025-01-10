<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->rol, $roles)) {
            // Redirige a la página de inicio o muestra un error si el usuario no tiene el rol adecuado
            return redirect(abort(401)); // o puedes usar abort(403);
        }

        return $next($request);
    }
}
