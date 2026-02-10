@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>
        <i class="fas fa-tachometer-alt"></i> Dashboard Admin
    </h1>
@stop

@section('content')
<div class="row">

    <!-- Clients -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $clientsCount }}</h3>
                <p>Clients</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ route('clients.index') }}" class="small-box-footer">
                Voir plus <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Categories -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $categoriesCount }}</h3>
                <p>Catégories</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">
                Voir plus <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Produits -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $produitsCount }}</h3>
                <p>Produits</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
            <a href="{{ route('produits.index') }}" class="small-box-footer">
                Voir plus <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Commandes -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $commandesCount }}</h3>
                <p>Commandes</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="{{ route('commandes.index') }}" class="small-box-footer">
                Voir plus <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

{{-- Actions rapides --}}
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-bolt"></i> Actions rapides
        </h3>
    </div>
    <div class="card-body">
        <a href="{{ route('clients.create') }}" class="btn btn-primary mr-2">
            <i class="fas fa-user-plus"></i> Ajouter client
        </a>

        <a href="{{ route('produits.create') }}" class="btn btn-warning mr-2">
            <i class="fas fa-box-open"></i> Ajouter produit
        </a>
    </div>
</div>
@stop
