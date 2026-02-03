<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;

Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('categories', CategorieController::class);
