@extends('layouts.client')

@section('title', 'Mes Commandes')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-box"></i> Mes Commandes
                    </h4>
                </div>
                <div class="card-body">
                    @if($commandes->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Référence</th>
                                        <th>Date</th>
                                        <th>Montant Total</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($commandes as $commande)
                                        <tr>
                                            <td>
                                                <strong>{{ $commande->reference }}</strong>
                                            </td>
                                            <td>{{ $commande->date_commande->format('d/m/Y') }}</td>
                                            <td>{{ number_format($commande->montant_total, 2, ',', ' ') }} €</td>
                                            <td>
                                                @switch($commande->statut)
                                                    @case('en_attente')
                                                        <span class="badge bg-warning">En attente</span>
                                                        @break
                                                    @case('confirmee')
                                                        <span class="badge bg-info">Confirmée</span>
                                                        @break
                                                    @case('en_preparation')
                                                        <span class="badge bg-primary">En préparation</span>
                                                        @break
                                                    @case('expediee')
                                                        <span class="badge bg-success">Expédiée</span>
                                                        @break
                                                    @case('livree')
                                                        <span class="badge bg-success">Livrée</span>
                                                        @break
                                                    @case('annulee')
                                                        <span class="badge bg-danger">Annulée</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-secondary">{{ $commande->statut }}</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary" onclick="showDetails(this)" data-id="{{ $commande->id }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    @if($commande->statut == 'en_attente')
                                                        <form method="POST" action="{{ route('client.commande.payer', $commande->id) }}" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-outline-success">
                                                                <i class="fas fa-credit-card"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <!-- Détails cachés -->
                                        <tr id="details-{{ $commande->id }}" style="display: none;">
                                            <td colspan="5">
                                                <div class="p-3 bg-light">
                                                    <h6>Détails de la commande:</h6>
                                                    @if($commande->lignes->count() > 0)
                                                        <div class="row">
                                                            @foreach($commande->lignes as $ligne)
                                                                <div class="col-md-6 mb-2">
                                                                    <small>
                                                                        <strong>{{ $ligne->quantite }}x</strong> 
                                                                        {{ $ligne->produit->nom ?? 'Produit supprimé' }} - 
                                                                        {{ number_format($ligne->prix_unitaire, 2, ',', ' ') }} €
                                                                    </small>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="text-muted">Aucun produit dans cette commande</p>
                                                    @endif
                                                    
                                                    @if($commande->notes)
                                                        <hr>
                                                        <p><strong>Notes:</strong> {{ $commande->notes }}</p>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-box-open" style="font-size: 4rem; color: #ccc;"></i>
                            <h4 class="mt-3">Aucune commande</h4>
                            <p class="text-muted">Vous n'avez pas encore passé de commande.</p>
                            <a href="{{ route('client.shop.produits') }}" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i> Commencer mes achats
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showDetails(button) {
    const commandeId = button.getAttribute('data-id');
    const detailsRow = document.getElementById('details-' + commandeId);
    if (detailsRow.style.display === 'none') {
        detailsRow.style.display = 'table-row';
    } else {
        detailsRow.style.display = 'none';
    }
}
</script>
@endsection
