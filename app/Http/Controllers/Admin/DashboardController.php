<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use App\Models\Categorie;
use App\Models\Produit;
use App\Models\Command;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'clientsCount'    => Utilisateur::count(),
            'categoriesCount' => Categorie::count(),
            'produitsCount'   => Produit::count(),
            'commandesCount'  => Command::count(),
        ]);
    }
}
