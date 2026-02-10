@extends('layouts.client')

@section('title', 'Mon Profil')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">
                        <i class="fas fa-user"></i> Mon Profil
                    </h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <input type="text" 
                                           id="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           name="name" 
                                           value="{{ old('name', $user->name) }}" 
                                           required 
                                           autofocus>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" 
                                           id="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           name="email" 
                                           value="{{ old('email', $user->email) }}" 
                                           required>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        <small>{{ $message }}</small>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('client.shop.produits') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Retour à la boutique
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle"></i> Informations
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                            <i class="fas fa-user fa-2x text-muted"></i>
                        </div>
                    </div>
                    
                    <h6 class="text-center">{{ $user->name }}</h6>
                    <p class="text-muted text-center">{{ $user->email }}</p>
                    
                    <hr>
                    
                    <div class="mb-3">
                        <small class="text-muted">Membre depuis</small>
                        <p class="mb-0">{{ $user->created_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Dernière connexion</small>
                        <p class="mb-0">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <hr>

                    <div class="d-grid">
                        <a href="{{ route('client.shop.panier') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-shopping-cart"></i> Mon Panier
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
