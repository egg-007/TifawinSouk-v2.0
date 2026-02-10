<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    private function getClientRole()
    {
        return Role::where('nom', 'client')->firstOrFail();
    }

    public function index()
    {
        $clients = Utilisateur::paginate(10);
        
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

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
        
        $data = $request->only(['nom', 'prenom', 'email', 'telephone', 'adresse']);
        $data['password'] = Hash::make($request->password);
        
        Utilisateur::create(array_merge(
            $data,
            ['role_id' => $this->getClientRole()->id]
        ));

        return redirect()->route('clients.index')
            ->with('success', 'Client créé avec succès!');
    }

    public function show(string $id)
    {
        $client = Utilisateur::with('role', 'commandes')->findOrFail($id);
        
        if ($client->role->nom !== 'client') {
            abort(404);
        }

        return view('clients.show', compact('client'));
    }

    public function edit(string $id)
    {
        $client = Utilisateur::findOrFail($id);
        
        if ($client->role->nom !== 'client') {
            abort(404);
        }

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, string $id)
    {
        $client = Utilisateur::findOrFail($id);
        
      

        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Rule::unique('utilisateurs')->ignore($client->id),
            ],
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        
        $data = $request->only(['nom', 'prenom', 'email', 'telephone', 'adresse']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        
        $client->update($data);

        return redirect()->route('clients.show', $client->id)
            ->with('success', 'Client mis à jour avec succès!');
    }

    public function destroy(string $id)
    {
        $client = Utilisateur::findOrFail($id);
        
        if ($client->role->nom !== 'client') {
            abort(404);
        }

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client supprimé avec succès!');
    }
}
