<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Fornisseur;

class FornisseurController extends Controller
{
    public function index()
    {
        $fornisseur = fornisseur::all();
        return view('fornisseur.index',compact($fornisseur));
    }

   
    public function create()
    {
        return view('fornisseur.create');
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:25|min:3',
            'statut' => 'nullable|string |max:100',
            'contact_personne' => 'string|max:150',
            'email' => 'required|string|min:100',
            'telephone' => 'required|string|min:10',
            'adresse' => 'required|string|min:5',
            'ville' => 'required|string|min:5|max:20',
            'pays' => 'required|string|min:5|max:20',
        ]);

        fornisseur::create($validated);

        return redirect()->route('fornisseur.index');
    }

    public function show($id)
    {
        $fornisseur = fornisseur::find($id);
        return view('fornisseur.show',compact($fornisseur));
        
    }

    
    public function edit(Fornisseur $fornisseur)
    {
        return view('fornisseur.edit', [
            'fornisseur' => $fornisseur
        ]);
    }

    public function update(Request $request, Fornisseur $fornisseur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:25|min:3',
            'statut' => 'nullable|string |max:100',
            'contact_personne' => 'string|max:150',
            'email' => 'required|string|min:100',
            'telephone' => 'required|string|min:10',
            'adresse' => 'required|string|min:5',
            'ville' => 'required|string|min:5|max:20',
            'pays' => 'required|string|min:5|max:20',
        ]);

        $fornisseur->update($validated);

        return redirect()->route('fornisseur.index');
    }

    public function destroy(Fornisseur $fornisseur)
    {
        $fornisseur->delete();

        return redirect()->route('fornisseur.index');
    }
}
