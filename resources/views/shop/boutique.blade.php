@extends('layouts.app')

@section('title', 'Boutique - Nos Produits')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Nos Produits</h1>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($produits->count() > 0)
                <div class="row">
                    @foreach($produits as $produit)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                @if($produit->image)
                                    <img src="{{ asset('storage/' . $produit->image) }}" class="card-img-top" alt="{{ $produit->nom }}" style="height: 200px; object-fit: cover;">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $produit->nom }}</h5>
                                    <p class="card-text">{{ Str::limit($produit->description, 100) }}</p>
                                    <p class="card-text">
                                        <strong>Prix:</strong> {{ number_format($produit->prix, 2, ',', ' ') }} €<br>
                                        <strong>Stock:</strong> {{ $produit->quantite_stock }} disponibles
                                    </p>
                                    <form action="{{ route('commande.ajouter') }}" method="POST" class="mt-3">
                                        @csrf
                                        <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                        <div class="form-group">
                                            <label for="quantite">Quantité:</label>
                                            <input type="number" name="quantite" class="form-control" min="1" max="{{ $produit->quantite_stock }}" value="1" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fas fa-cart-plus"></i> Ajouter au panier
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <p class="text-muted">Aucun produit disponible actuellement.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
