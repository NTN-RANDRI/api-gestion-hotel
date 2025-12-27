<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'date_arrivee',
        'date_depart',
        'annuler',
        'nombre_personnes',
        'montant_total',
        'type',
        'client_id',
    ];

    protected $appends = [
        'montant_restant',
        'statut'
    ];

    protected $casts = [
        'date_debut' => 'datetime:Y-m-d H:i:s',
        'date_fin' => 'datetime:Y-m-d H:i:s',
        'date_arrivee' => 'datetime:Y-m-d H:i:s',
        'date_depart' => 'datetime:Y-m-d H:i:s',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function chambres(): BelongsToMany
    {
        return $this->belongsToMany(Chambre::class, 'chambre_reservation');
    }

    public function paiements(): HasMany
    {
        return $this->hasMany(Paiement::class);
    }

    // Attributes
    public function getMontantRestantAttribute()
    {
        $totalPaye = $this->paiements()->sum('montant');

        return $this->montant_total - $totalPaye;
    }

    public function getStatutAttribute()
    {
        $today = now();

        $dateDebut = Carbon::parse($this->date_debut);
        $dateFin = Carbon::parse($this->date_fin);

        if ($this->annuler) {
            return 'Annulée';
        }

        if (!is_null($this->date_depart)) {
            return 'Terminée';
        }

        if (!is_null($this->date_arrivee)) {
            return 'Confirmée';
        }

        if ($dateFin->lt($today)) {
            return 'En retard';
        }

        if ($dateDebut->lte($today) && $dateFin->gt($today)) {
            return 'En cours';
        }

        if ($dateDebut->gt($today)) {
            return 'En attente';
        }

        return 'Statut inconnu';
    }


}
