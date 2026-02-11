
@extends('layouts.client')

@section('title', 'Mon Panier')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-cart3"></i> Mon Panier</h2>
        <div>
            <a href="{{ route('client.shop.produits') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Continuer mes achats
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($commande && $commande->lignes->count() > 0)
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Articles ({{ $commande->lignes->count() }})</h5>
                    </div>
                    <div class="card-body">
                        @foreach($commande->lignes as $ligne)
                            <div class="row mb-3 pb-3 border-bottom">
                                <div class="col-md-2">
                                    @if($ligne->produit->image)
                                        <img src="{{ $ligne->produit->image }}" class="img-fluid rounded" alt="{{ $ligne->produit->nom }}">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 80px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <h6>{{ $ligne->produit->nom }}</h6>
                                    <p class="text-muted small">{{ Str::limit($ligne->produit->description, 100) }}</p>
                                    <p class="mb-0">
                                        <span class="badge bg-primary">{{ $ligne->produit->categorie->nom ?? 'Non catégorisé' }}</span>
                                    </p>
                                </div>
                                <div class="col-md-2 text-center">
                                    <p class="mb-1">{{ $ligne->quantite }} x</p>
                                    <p class="text-muted">{{ number_format($ligne->prix_unitaire, 2) }} €</p>
                                </div>
                                <div class="col-md-2 text-end">
                                    <h5 class="text-primary">{{ number_format($ligne->prix_total, 2) }} €</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Récapitulatif</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Sous-total:</span>
                            <span>{{ number_format($commande->montant_total, 2) }} €</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Livraison:</span>
                            <span>Gratuite</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <h5>Total:</h5>
                            <h5 class="text-primary">{{ number_format($commande->montant_total, 2) }} €</h5>
                        </div>
                        
                        <form method="POST" action="{{ route('commande.payer', $commande->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-credit-card"></i> Payer la commande
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 4rem; color: #ccc;"></i>
            <h4 class="mt-3">Votre panier est vide</h4>
            <p class="text-muted">Ajoutez des produits pour commencer vos achats.</p>
            <a href="{{ route('client.shop.produits') }}" class="btn btn-primary">
                <i class="bi bi-shop"></i> Voir les produits
            </a>
        </div>
    @endif
</div>
@endsection
