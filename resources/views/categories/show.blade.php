@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails de la catégorie</h2>

    <p><strong>Nom :</strong> {{ $categorie->nom }}</p>
    <p><strong>Description :</strong> {{ $categorie->description }}</p>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
