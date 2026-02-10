<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
   
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::user();

        if (!$user || $user->role->nom !== $role) {
            abort(403, 'Accès refusé.'); 
        }

        return $next($request);
    }
}
