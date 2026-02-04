<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornisseur extends Model
{
    use HasFactory;
    
    protected $table = 'fournisseurs';
    
    protected $fillable = [
        'nom', 'contact_personne', 'email', 'telephone', 'adresse', 'ville', 'pays', 'statut'
    ];

    public function produits()
    {
        return $this->hasMany(Produit::class);
    }
}
