<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TypeChambre as TypeChambreModel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Chambre extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'prix_nuit',
        'description',
        'type_chambre_id',
    ];

    protected $with = ['typeChambre', 'equipements'];

    public function typeChambre(): BelongsTo
    {
        return $this->belongsTo(TypeChambreModel::class);
    }

    public function equipements(): BelongsToMany
    {
        return $this->belongsToMany(Equipement::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

}
