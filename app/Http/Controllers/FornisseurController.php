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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fornisseur.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $fornisseur = fornisseur::find($id);
        return view('fornisseur.show',compact($fornisseur));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fornisseur $fornisseur)
    {
        return view('fornisseur.edit', [
            'fornisseur' => $fornisseur
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornisseur $fornisseur)
    {
        $fornisseur->delete();

        return redirect()->route('fornisseur.index');
    }
}
