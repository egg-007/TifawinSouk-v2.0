<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fornisseur extends Model
{
    protected $fillable = [
        'nom', 'contact_personne', 'email', 'telephone', 'adresse', 'ville', 'pays', 'statut'
    ];

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
