<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'utilisateurs';
    
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'telephone', 'adresse', 'role_id', 'email_verified_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

  
    /**
     * Get the full name of the user.
     */
    public function getNameAttribute()
    {
        return $this->nom . ' ' . $this->prenom;
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function commandes()
    {
        return $this->hasMany(Command::class);
    }
}
