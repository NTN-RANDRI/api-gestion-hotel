<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipement extends Model
{
    use HasFactory;

    protected $fillable = [
        "nom",
        "description",
    ];

    public function chambres(): BelongsToMany
    {
        return $this->belongsToMany(Chambre::class);
    }
    
}
