<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        // Vérifier le rôle de l'utilisateur
        if ($role === 'admin' && $user->role_id != 1) {
            // Si l'utilisateur n'est pas admin (role_id != 1) et essaie d'accéder aux routes admin
            abort(403, 'Accès non autorisé - Réservé aux administrateurs');
        }

        if ($role === 'client' && $user->role_id != 2) {
            // Si l'utilisateur n'est pas client (role_id != 2) et essaie d'accéder aux routes client
            abort(403, 'Accès non autorisé - Réservé aux clients');
        }

        return $next($request);
    }
}
 