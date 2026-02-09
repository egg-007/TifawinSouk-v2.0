<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Routes pour les clients - CRUD essentiel uniquement
Route::get('/Admin/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('/Admin/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/Admin/clients', [ClientController::class, 'store'])->name('clients.store');
Route::get('/Admin/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
Route::get('/Admin/clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/Admin/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('/Admin/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

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