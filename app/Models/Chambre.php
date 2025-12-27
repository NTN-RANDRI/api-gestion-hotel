<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\TypeChambre as TypeChambreModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    protected $appends = [
        'statut',
    ];

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

    public function reservations(): BelongsToMany
    {
        return $this->belongsToMany(Reservation::class, 'chambre_reservation');
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }

    // Attributes
    public function getStatutAttribute()
    {
        $today = Carbon::today();

        /** 1. Chambre en maintenance (maintenance active) **/
        $maintenanceEnCours = $this->maintenances()
            ->whereNull('date_fin') // ou ton champ qui indique la fin de la maintenance
            ->exists();

        if ($maintenanceEnCours) {
            return 'En maintenance';
        }

        /** 2. Récupération des réservations liées à cette chambre **/
        $reservation = $this->reservations()
            ->where(function ($query) use ($today) {
                $query->where('date_debut', '<=', $today)
                    ->where('date_fin', '>=', $today)
                    ->orWhereNotNull('date_arrivee'); // confirmée
            })
            ->first();

        /** 3. Si aucune réservation en cours/à venir **/
        if (!$reservation) {
            return 'Disponible';
        }

        /** 4. Occupée : le client est arrivé (date_arrivee != null) **/
        if (!is_null($reservation->date_arrivee) && is_null($reservation->date_depart)) {
            return 'Occupée';
        }

        /** 5. Réservée : réservation future ou en attente **/
        return 'Réservée';
    }

    public function getEnMaintenanceAttribute()
    {

    }

}
