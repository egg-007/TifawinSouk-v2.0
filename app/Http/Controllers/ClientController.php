<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Utilisateur::with('role')->whereHas('role', function($query) {
            $query->where('nom', 'client');
        })->paginate(10);
        
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:utilisateurs',
            'password' => 'required|string|min:8|confirmed',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
        ]);

        $clientRole = Role::where('nom', 'client')->first();
        
        $client = Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'adresse' => $request->adresse,
            'role_id' => $clientRole->id,
        ]);

        return response()->json($client->load('role'), 201);
    }
}
