<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    
    protected $table = 'produits';
    
    protected $fillable = [
        'categorie_id','reference', 'nom', 'description', 'prix', 'quantite_stock', 'image', 'fournisseur_id', 'statut'
    ];

    public function fournisseur()
    {
        return $this->belongsTo(Fornisseur::class);
    }

    public function Commande()
    {
        return $this->belongsToMany(Command::class, 'lignes_commandes', 'produit_id', 'commande_id')
                    ->withPivot('quantite', 'prix_unitaire', 'total');
    }
}
