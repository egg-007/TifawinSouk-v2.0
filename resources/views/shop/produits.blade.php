@extends('layouts.app')

@section('title', 'Boutique - Nos Produits')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-shop"></i> Boutique - Nos Produits</h2>
        <div>
            <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($produits as $produit)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($produit->image)
                        <img src="{{ $produit->image }}" class="card-img-top" alt="{{ $produit->nom }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $produit->nom }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($produit->description, 80) }}</p>
                        
                        <div class="mb-2">
                            <span class="badge bg-primary">{{ $produit->categorie->nom ?? 'Non catégorisé' }}</span>
                            <span class="badge bg-info">{{ $produit->fournisseur->nom ?? 'Fournisseur' }}</span>
                        </div>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-primary mb-0">{{ number_format($produit->prix, 2) }} €</h4>
                                <small class="text-muted">Stock: {{ $produit->quantite_stock }}</small>
                            </div>
                            
                            <form method="POST" action="{{ route('commande.ajouter') }}" class="d-grid">
                                @csrf
                                <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                
                                <div class="input-group mb-2">
                                    <input type="number"
                                           name="quantite"
                                           min="1"
                                           max="{{ $produit->quantite_stock }}"
                                           value="1"
                                           class="form-control"
                                           placeholder="Quantité">
                                    <span class="input-group-text">pcs</span>
                                </div>
                                
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-cart-plus"></i> Ajouter au panier
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Aucun produit disponible pour le moment.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
