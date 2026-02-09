@extends('layouts.app')

@section('title', 'Produits - Admin')

@section('content')
<div class="container mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestion des Produits</h1>
        <a href="{{ route('produits.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Ajouter un produit
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Liste des Produits</h5>
        </div>
        <div class="card-body">
            @if($produits->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Référence</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Stock</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($produits as $produit)
                            <tr>
                                <td>{{ $produit->id }}</td>
                                <td>{{ $produit->reference ?? '-' }}</td>
                                <td>{{ $produit->nom }}</td>
                                <td>{{ Str::limit($produit->description, 50) }}</td>
                                <td>{{ number_format($produit->prix, 2, ',', ' ') }} €</td>
                                <td>{{ $produit->quantite_stock }}</td>
                                <td>
                                    <span class="badge bg-{{ $produit->statut == 'disponible' ? 'success' : 'warning' }}">
                                        {{ $produit->statut }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-sm btn-info">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de supprimer ce produit ?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <p class="text-muted">Aucun produit trouvé.</p>
                    <a href="{{ route('produits.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Ajouter le premier produit
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
