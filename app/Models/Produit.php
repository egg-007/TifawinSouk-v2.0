<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    
    protected $table = 'produits';
    
    protected $fillable = [
        'reference', 'nom', 'description', 'prix', 'quantite_stock', 'image', 'fournisseur_id', 'statut'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fornisseur::class);
    }

    public function lignesCommande()
    {
        return $this->hasMany(LigneCommand::class);
    }
}
