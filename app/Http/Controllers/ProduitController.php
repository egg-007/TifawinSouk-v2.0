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
        $fournisseurs = \App\Models\Fornisseur::all();
        $categories = \App\Models\Categorie::all();
        return view('produit.create', compact('fournisseurs', 'categories'));
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
            'statut' => 'required|in:actif,inactif',
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

    public function edit($id)
    {
        $produit = Produit::findOrFail($id);
        $fournisseurs = \App\Models\Fornisseur::all();
        $categories = \App\Models\Categorie::all();
        return view('produit.edit', compact('produit', 'fournisseurs', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::findOrFail($id);
        $validated = $request->validate([
            'reference' => 'nullable|string|max:50',
            'nom' => 'required|string|min:3|max:25',
            'description' => 'required|string|max:255',
            'prix' => 'required|numeric|min:0',
            'quantite_stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png',
            'fournisseur_id' => 'required|integer',
            'categorie_id' => 'nullable|integer',
            'statut' => 'required|in:actif,inactif',
        ]);

        $produit->update($validated);

        return redirect()->route('produits.index')
            ->with('success', 'Produit modifié avec succès');
    }

    public function destroy($id)
    {
        try {
            $produit = Produit::findOrFail($id);
            $produit->delete();

            return redirect()->route('produits.index')
                ->with('success', 'Produit supprimé avec succès');
        } catch (\Illuminate\Database\QueryException $e) {
            // Si le produit est utilisé dans des commandes
            if (str_contains($e->getMessage(), 'foreign key constraint')) {
                return redirect()->route('produits.index')
                    ->with('error', 'Ce produit ne peut pas être supprimé car il est utilisé dans des commandes.');
            }
            
            return redirect()->route('produits.index')
                ->with('error', 'Une erreur est survenue lors de la suppression.');
        }
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
