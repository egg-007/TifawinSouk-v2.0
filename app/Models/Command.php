<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;
    
    protected $table = 'commandes';
    
    protected $fillable = [
        'reference', 'date_commande', 'montant_total', 'statut', 'utilisateur_id', 'notes'
    ];

    protected $casts = [
        'date_commande' => 'date',
        'montant_total' => 'decimal:2'
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function lignes()
    {
        return $this->hasMany(LigneCommand::class, 'commande_id');
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'lignes_commande', 'commande_id', 'produit_id')
                    ->withPivot('quantite', 'prix_unitaire', 'prix_total');
    }
}
