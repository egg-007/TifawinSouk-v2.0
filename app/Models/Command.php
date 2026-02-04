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

    public function lignesCommande()
    {
        return $this->hasMany(LigneCommand::class);
    }
}
