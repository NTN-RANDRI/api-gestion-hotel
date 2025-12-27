<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',  
        'prenom',
        'telephone',
        'cin',
    ];

    // RELATIONS
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }
    
}
