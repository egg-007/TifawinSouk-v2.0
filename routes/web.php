<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user && $user->role_id == 1) {
        // Redirection directe vers le dashboard admin pour éviter le middleware client
        return redirect('/admin/dashboard');
    }
    return redirect()->route('client.shop.produits');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Route AdminLTE Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware('admin')
    ->name('admin.dashboard');

// Route AdminLTE Dashboard (alternative)
// Route::get('/Admin/dashboard', [DashboardController::class, 'index'])
//     ->middleware('auth')
//     ->name('admin.dashboard.alt');

// Routes CLIENT - Espace client protégé par auth et role:client
Route::middleware(['auth'])->prefix('/client')->group(function () {
    Route::get('/shop/produits', function () {
        $user = Auth::user();
        if ($user && $user->role_id == 1) {
            return redirect('/admin/dashboard');
        }
        return app(\App\Http\Controllers\ProduitController::class)->shop();
    })->name('client.shop.produits');
    
    Route::post('/commande/ajouter', [CommandeController::class, 'ajouterProduit'])->name('client.commande.ajouter');
    Route::get('/shop/panier', [CommandeController::class, 'panier'])->name('client.shop.panier');
    Route::post('/commande/payer/{id}', [CommandeController::class, 'payer'])->name('client.commande.payer');
    Route::get('/profile', [ProfileController::class, 'clientProfile'])->name('client.profile');
});

// Routes ADMIN - protégées par admin middleware
Route::middleware('admin')->prefix('/Admin')->group(function () {
    // Routes pour les clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

    // Routes pour les catégories
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categories.show');
    Route::get('/categories/{id}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

    // Routes pour les produits
    Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
    Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');
    Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
    Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
    Route::get('/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
    Route::put('/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
    Route::delete('/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.destroy');
});
