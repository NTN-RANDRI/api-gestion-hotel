<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'date_prevus',
        'description',
        'chambre_id',
    ];

    protected $appends = [
        'statut'
    ];

    public function chambre(): BelongsTo
    {
        return $this->belongsTo(Chambre::class);
    }

    // Attributes
    public function getStatutAttribute()
    {
        $today = Carbon::today();
        $dateDebut = Carbon::parse($this->date_debut);
        $datePrevus = $this->date_prevus ? Carbon::parse($this->date_prevus) : null;

        if ($this->date_fin) {
            return 'Terminée';
        }

        if ($dateDebut->gt($today)) {
            return 'En attente';
        }

        if ($datePrevus && $datePrevus->lt($today)) {
            return 'En retard';
        }

        if ($dateDebut->lte($today)) {
            return 'En cours';
        }

        return 'Inconnue';
    }
}
