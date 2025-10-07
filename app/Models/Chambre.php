<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TypeChambre as TypeChambreModel;

class Chambre extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero',
        'prix_nuit',
        'description',
        'type_chambre_id',
    ];

    protected $with = ['typeChambre'];

    public function typeChambre(): BelongsTo
    {
        return $this->belongsTo(TypeChambreModel::class);
    }

}
