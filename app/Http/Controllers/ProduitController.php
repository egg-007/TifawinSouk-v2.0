<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Produit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produit = produit::all();
        return view('produit.index',compact($produit));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'nullable|string |max:50',
            'nom' => 'required|string|max:25|min:3',
            'description' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite_stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png',
            'fournisseur_id' => 'required|numeric|min:0',
            'categorie_id' => 'required|numeric|min:0',
            'statut' => 'nullable|string |max:100',
        ]);

        produit::create($validated);

        return redirect()->route('produit.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produit = produit::find($id);
        return view('produit.show',compact($produit));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produit)
    {
        return view('produit.edit', [
            'produit' => $produit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'reference' => 'nullable|string |max:50',
            'nom' => 'required|string|max:25|min:3',
            'description' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite_stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,png',
            'fournisseur_id' => 'required|numeric|min:0',
            'categorie_id' => 'required|numeric|min:0',
            'statut' => 'nullable|string |max:100',
        ]);

        $produit->update($validated);

        return redirect()->route('produit.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('produit.index');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $produits = Produit::where('nom', 'like', '%'.$query.'%')
            ->orWhere('description', 'like', '%'.$query.'%')
            ->get();

        return view('produit.search_results', compact('produits', 'query'));
    }
}
