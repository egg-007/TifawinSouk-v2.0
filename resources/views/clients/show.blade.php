@extends('layouts.app')

@section('title', 'Détails du Client')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-person"></i> Informations du Client</h5>
                <div>
                    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <a href="{{ route('clients.index') }}" class="btn btn-secondary btn-sm">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>ID:</strong> {{ $client->id }}</p>
                        <p><strong>Nom:</strong> {{ $client->nom }}</p>
                        <p><strong>Prénom:</strong> {{ $client->prenom }}</p>
                        <p><strong>Email:</strong> {{ $client->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Téléphone:</strong> {{ $client->telephone ?? 'Non renseigné' }}</p>
                        <p><strong>Adresse:</strong> {{ $client->adresse ?? 'Non renseignée' }}</p>
                        <p><strong>Rôle:</strong> <span class="badge bg-primary">{{ $client->role->nom }}</span></p>
                        <p><strong>Date de création:</strong> {{ $client->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
