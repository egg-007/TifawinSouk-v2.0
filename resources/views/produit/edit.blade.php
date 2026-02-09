@extends('layouts.app')

@section('title', 'Modifier un Produit - Admin')

@section('content')
<div class="container mx-auto">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Modifier: {{ $produit->nom }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nom" class="form-label">Nom du produit *</label>
                                <input type="text" name="nom" class="form-control @error('nom', 'is-invalid')" value="{{ $produit->nom }}" required>
                                @error('nom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="reference" class="form-label">Référence</label>
                                <input type="text" name="reference" class="form-control @error('reference', 'is-invalid')" value="{{ $produit->reference }}">
                                @error('reference')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea name="description" class="form-control @error('description', 'is-invalid')" rows="3" required>{{ $produit->description }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="prix" class="form-label">Prix *</label>
                                <input type="number" name="prix" class="form-control @error('prix', 'is-invalid')" value="{{ $produit->prix }}" step="0.01" min="0" required>
                                @error('prix')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="quantite_stock" class="form-label">Quantité en stock *</label>
                                <input type="number" name="quantite_stock" class="form-control @error('quantite_stock', 'is-invalid')" value="{{ $produit->quantite_stock }}" min="0" required>
                                @error('quantite_stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fournisseur_id" class="form-label">Fournisseur *</label>
                                <select name="fournisseur_id" class="form-control @error('fournisseur_id', 'is-invalid')" required>
                                    <option value="">Choisir un fournisseur</option>
                                    {{-- Ici tu peux ajouter la liste des fournisseurs depuis la base de données --}}
                                </select>
                                @error('fournisseur_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="categorie_id" class="form-label">Catégorie</label>
                                <select name="categorie_id" class="form-control @error('categorie_id', 'is-invalid')">
                                    <option value="">Choisir une catégorie</option>
                                    {{-- Ici tu peux ajouter la liste des catégories depuis la base de données --}}
                                </select>
                                @error('categorie_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="statut" class="form-label">Statut</label>
                                <select name="statut" class="form-control @error('statut', 'is-invalid')">
                                    <option value="disponible" {{ $produit->statut == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                    <option value="indisponible" {{ $produit->statut == 'indisponible' ? 'selected' : '' }}>Indisponible</option>
                                    <option value="en_rupture" {{ $produit->statut == 'en_rupture' ? 'selected' : '' }}>En rupture</option>
                                </select>
                                @error('statut')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control @error('image', 'is-invalid')" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Mettre à jour le produit
                                </button>
                                <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Annuler
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection