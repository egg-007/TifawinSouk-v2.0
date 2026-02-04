@extends('layouts.app')

@section('title', 'Liste des Clients')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="bi bi-people"></i> Liste des Clients</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouveau Client
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Clients ({{ $clients->total() }})</h5>
    </div>
    <div class="card-body">
        @if($clients->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->nom }}</td>
                                <td>{{ $client->prenom }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->telephone ?? '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-sm btn-info" title="Voir">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-sm btn-warning" title="Modifier">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Supprimer" 
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
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

            <div class="d-flex justify-content-center mt-3">
                {{ $clients->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people display-1 text-muted"></i>
                <h4 class="mt-3">Aucun client trouvé</h4>
                <p class="text-muted">Commencez par ajouter votre premier client.</p>
                <a href="{{ route('clients.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Ajouter un Client
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
