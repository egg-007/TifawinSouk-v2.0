@extends('layouts.admin')

@section('title', 'Détails du Produit - Admin')

@section('main_content')
<div class="container mx-auto">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ $produit->nom }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>ID:</strong> {{ $produit->id }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Référence:</strong> {{ $produit->reference ?? '-' }}</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <p><strong>Description:</strong></p>
                            <p>{{ $produit->description }}</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Prix:</strong> {{ number_format($produit->prix, 2, ',', ' ') }} €</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Stock:</strong> {{ $produit->quantite_stock }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Statut:</strong> 
                                <span class="badge bg-{{ $produit->statut == 'disponible' ? 'success' : 'warning' }}">
                                    {{ $produit->statut }}
                                </span>
                            </p>
                        </div>
                    </div>
                    
                    @if($produit->image)
                        <div class="row mt-3">
                            <div class="col-md-12 text-center">
                                <img src="{{ asset('storage/' . $produit->image) }}" class="img-fluid rounded" alt="{{ $produit->nom }}" style="max-height: 300px;">
                            </div>
                        </div>
                    @endif
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de supprimer ce produit ?')">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12">
                <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
</div>
@endsection