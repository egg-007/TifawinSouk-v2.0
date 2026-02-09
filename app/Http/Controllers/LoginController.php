<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->guard()->attempt($credentials)) {
            return redirect()->intended('/home');
        }

        return back()->withErrors(  [
            'email' => 'Invalid credentials.',
        ]);
    }

    public function logout()
    {
        auth()->guard()->logout();
        return redirect()->route('home');
    }
}
