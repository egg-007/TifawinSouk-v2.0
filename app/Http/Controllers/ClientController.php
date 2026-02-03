<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Utilisateur::with('role', 'commandes')->findOrFail($id);
        
        if ($client->role->nom !== 'client') {
            return response()->json(['message' => 'Ce n\'est pas un client'], 404);
        }

        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Utilisateur::findOrFail($id);
        
        if ($client->role->nom !== 'client') {
            return response()->json(['message' => 'Ce n\'est pas un client'], 404);
        }

        $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'string',
                'email','max:255',
                Rule::unique('utilisateurs')->ignore($client->id),
            ],
            'password' => 'sometimes|required|string|min:8|confirmed',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
        ]);

        $updateData = $request->only(['nom', 'prenom', 'email', 'telephone', 'adresse']);
        
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $client->update($updateData);

        return response()->json($client->load('role'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Utilisateur::findOrFail($id);
        
        if ($client->role->nom !== 'client') {
            return response()->json(['message' => 'Ce n\'est pas un client'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Client supprimé avec succès']);
    }

    /**
     * Search clients by name or email
     */
    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2'
        ]);

        $query = $request->query;
        
        $clients = Utilisateur::with('role')
            ->whereHas('role', function($q) {
                $q->where('nom', 'client');
            })
            ->where(function($q) use ($query) {
                $q->where('nom', 'like', "%{$query}%")
                  ->orWhere('prenom', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%");
            })
            ->paginate(10);

        return response()->json($clients);
    }

    /**
     * Get client orders
     */
    public function orders(string $id)
    {
        $client = Utilisateur::findOrFail($id);
        
        if ($client->role->nom !== 'client') {
            return response()->json(['message' => 'Ce n\'est pas un client'], 404);
        }

        $orders = $client->commandes()->with('lignesCommande.produit')->paginate(10);
        
        return response()->json($orders);
    }
}
