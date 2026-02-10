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

        // Vérifier si l'utilisateur est administrateur
        // Vous pouvez adapter cette logique selon votre système de rôles
        $user = Auth::user();
        
        // Option 1: Vérifier par email (pour les admins spécifiques)
        $adminEmails = ['admin@example.com', 'superadmin@example.com']; // Ajoutez vos emails admin
        
        // Option 2: Vérifier par champ 'role' si vous l'avez dans votre table users
        // if ($user->role !== 'admin') { ... }
        
        // Option 3: Vérifier par champ 'is_admin' si vous l'avez
        // if (!$user->is_admin) { ... }
        
        if (!in_array($user->email, $adminEmails)) {
            // Rediriger les non-admins vers l'espace client
            return redirect()->route('client.shop.produits');
        }

        return $next($request);
    }
}
