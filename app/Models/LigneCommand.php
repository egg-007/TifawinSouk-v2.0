<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneCommand extends Model
{
    use HasFactory;
    
    protected $table = 'lignes_commande';
    
    protected $fillable = [
        'commande_id', 'produit_id', 'quantite', 'prix_unitaire', 'prix_total'
    ];

    protected $casts = [
        'prix_unitaire' => 'decimal:2',
        'prix_total' => 'decimal:2'
    ];

    public function commande()
    {
        return $this->belongsTo(Command::class);
    }

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }
    
}
