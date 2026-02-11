<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Vérifier si l'utilisateur est administrateur depuis la base de données
        $user = Auth::user();
        
        // DEBUG: Afficher les informations de l'utilisateur
        // dd([
        //     'user_id' => $user->id,
        //     'user_email' => $user->email,
        //     'user_role' => $user->role ?? 'non défini',
        //     'user_is_admin' => $user->is_admin ?? 'non défini',
        //     'user_attributes' => $user->getAttributes()
        // ]);
        
        // Vérifier si l'utilisateur est administrateur (role_id = 1)
        if ($user->role_id == 1) {
            return $next($request);
        }
        
        // Rediriger les non-admins vers une page d'accès refusé
        return redirect()->route('login')->with('error', 'Accès réservé aux administrateurs');
    }
}
