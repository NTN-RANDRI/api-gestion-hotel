<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeChambre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'nombre_lits',
        'capacite_max',
        'description',
    ];

    protected $appends = [
        'total_chambres',
    ];

    public function chambres(): HasMany
    {
        return $this->hasMany(Chambre::class);
    }
    
    // Attributes
    public function getTotalChambresAttribute()
    {
        return $this->chambres()->count();
    }
    
}
