<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Routes SHOP - CLIENT (pour acheter) - PLACÉES EN PREMIER
Route::get('/shop/produits', [ProduitController::class, 'shop'])->name('shop.produits');
Route::post('/commande/ajouter', [CommandeController::class, 'ajouterProduit'])->name('commande.ajouter');
Route::get('/shop/panier', [CommandeController::class, 'panier'])->name('shop.panier');

// Routes pour les clients - CRUD essentiel uniquement
Route::get('/Admin/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/Admin/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/Admin/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/Admin/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
Route::get('/Admin/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/Admin/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/Admin/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');


// Routes SHOP - CLIENT (pour acheter) - PLACÉES EN PREMIER
Route::get('/shop/produits', [ProduitController::class, 'shop'])->name('shop.produits');
Route::post('/commande/ajouter', [CommandeController::class, 'ajouterProduit'])->name('commande.ajouter');
Route::get('/shop/panier', [CommandeController::class, 'panier'])->name('shop.panier');
Route::post('/commande/payer/{id}', [CommandeController::class, 'payer'])->name('commande.payer');

// Routes pour les catégories - CRUD admin
Route::get('/Admin/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/Admin/categories/create', [CategorieController::class, 'create'])->name('categories.create');
Route::post('/Admin/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/Admin/categories/{id}', [CategorieController::class, 'show'])->name('categories.show');
Route::get('/Admin/categories/{id}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
Route::put('/Admin/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/Admin/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

// Routes pour les produits - ADMIN CRUD
Route::get('/Admin/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/Admin/produits/create', [ProduitController::class, 'create'])->name('produits.create');
Route::post('/Admin/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/Admin/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/Admin/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
Route::put('/Admin/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/Admin/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.destroy');
