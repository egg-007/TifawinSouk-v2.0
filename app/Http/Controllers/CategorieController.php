<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::paginate(10); 
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $data = $request->only(['nom', 'description']);
        Categorie::create($data);

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie créée avec succès!');
    }

    public function show($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('categories.show', compact('categorie'));
    }

    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('categories.edit', compact('categorie'));
    }

    public function update(Request $request, $id)
    {
        $categorie = Categorie::findOrFail($id);

        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $data = $request->only(['nom', 'description']);
        $categorie->update($data);

        return redirect()->route('categories.show', $categorie->id)
            ->with('success', 'Catégorie mise à jour avec succès!');
    }

    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Catégorie supprimée avec succès!');
    }
}
