<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return view('produit.index', compact('produits'));
    }

    public function create()
    {
        return view('produit.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'nullable|string|max:50',
            'nom' => 'required|string|min:3|max:25',
            'description' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite_stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png',
            'fournisseur_id' => 'required|integer',
            'categorie_id' => 'nullable|integer',
            'statut' => 'nullable|string|max:100',
        ]);

        Produit::create($validated);

        return redirect()->route('produits.index')
            ->with('success', 'Produit ajouté avec succès');
    }

    public function show($id)
    {
        $produit = Produit::findOrFail($id);
        return view('produit.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        return view('produit.edit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'reference' => 'nullable|string|max:50',
            'nom' => 'required|string|min:3|max:25',
            'description' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite_stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png',
            'fournisseur_id' => 'required|integer',
            'categorie_id' => 'nullable|integer',
            'statut' => 'nullable|string|max:100',
        ]);

        $produit->update($validated);

        return redirect()->route('produits.index')
            ->with('success', 'Produit modifié avec succès');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('produits.index')
            ->with('success', 'Produit supprimé');
    }


    public function shop()
    {
        $produits = Produit::all();
        return view('shop.boutique', compact('produits'));
    }

    public function boutique()
    {
        $produits = Produit::all();
        return view('shop.boutique', compact('produits'));
    }
}
