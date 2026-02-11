<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            // Vérifier si c'est un admin et rediriger vers le bon dashboard
            $user = $request->user();
            
            // Option 1: Vérifier par champ 'role'
            if (isset($user->role) && $user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            
            // Option 2: Vérifier par champ 'is_admin'
            if (isset($user->is_admin) && $user->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            
            // Option 3: Vérifier par email (fallback)
            $adminEmails = ['admin@test.com', 'superadmin@example.com'];
            if (in_array($user->email, $adminEmails)) {
                return redirect()->route('admin.dashboard');
            }
            
            return redirect()->route('client.shop.produits');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // Même logique pour la redirection après vérification
        $user = $request->user();
        
        // Option 1: Vérifier par champ 'role'
        if (isset($user->role) && $user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        // Option 2: Vérifier par champ 'is_admin'
        if (isset($user->is_admin) && $user->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        
        // Option 3: Vérifier par email (fallback)
        $adminEmails = ['admin@test.com', 'superadmin@example.com'];
        if (in_array($user->email, $adminEmails)) {
            return redirect()->route('admin.dashboard');
        }
        
        return redirect()->route('client.shop.produits');
    }
}
