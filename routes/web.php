<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;


use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;

Route::get('/', function () {
    return view('welcome');
});

// Route de test pour vérifier si Laravel lit ce fichier
Route::get('/test-routes', function () {
    return 'Routes are loaded! Shop routes should work.';
});



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

<<<<<<< HEAD
Route::middleware(['guest'])->group(function() {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/Admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Routes pour les produit - CRUD essentiel uniquement

Route::get('/Admin/produit', [ClientController::class, 'index'])->name('produit.index');
Route::get('/Admin/produit/create', [ClientController::class, 'create'])->name('produit.create');
Route::post('/Admin/produit', [ClientController::class, 'store'])->name('produit.store');
Route::get('/Admin/produit/{id}', [ClientController::class, 'show'])->name('produit.show');
Route::get('/Admin/produit/{id}/edit', [ClientController::class, 'edit'])->name('produit.edit');
Route::put('/Admin/produit/{id}', [ClientController::class, 'update'])->name('produit.update');
Route::delete('/Admin/produit/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

// Routes pour les fornisseur - CRUD essentiel uniquement

Route::get('/Admin/fornisseur', [ClientController::class, 'index'])->name('fornisseur.index');
Route::get('/Admin/fornisseur/create', [ClientController::class, 'create'])->name('fornisseur.create');
Route::post('/Admin/fornisseur', [ClientController::class, 'store'])->name('fornisseur.store');
Route::get('/Admin/fornisseur/{id}', [ClientController::class, 'show'])->name('fornisseur.show');
Route::get('/Admin/fornisseur/{id}/edit', [ClientController::class, 'edit'])->name('fornisseur.edit');
Route::put('/Admin/fornisseur/{id}', [ClientController::class, 'update'])->name('fornisseur.update');
Route::delete('/Admin/fornisseur/{id}', [ClientController::class, 'destroy'])->name('fornisseur.destroy');
=======
// Routes pour les produits - ADMIN CRUD
Route::get('/Admin/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/Admin/produits/create', [ProduitController::class, 'create'])->name('produits.create');
Route::post('/Admin/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/Admin/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/Admin/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
Route::put('/Admin/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/Admin/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.destroy');
>>>>>>> 64b5f5b124f4d32959c1ce9403e691dc8ce98ea1
