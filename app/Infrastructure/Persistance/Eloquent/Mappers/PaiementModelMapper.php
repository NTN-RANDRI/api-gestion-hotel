<?php 

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Paiement;
use App\Models\Paiement as PaiementModel;
use Illuminate\Database\Eloquent\Collection;

class PaiementModelMapper
{

    public static function toArray(Paiement $paiement): array
    {
        return [
            'montant' => $paiement->getMontant(),
            'mode' => $paiement->getMode(),
            'telephone' => $paiement->getTelephone(),
            'statut' => $paiement->getStatut(),
        ];
    }

    public static function toDomain(PaiementModel $paiementModel): Paiement
    {
        return new Paiement(
            id: $paiementModel->id,
            montant: $paiementModel->montant,
            mode: $paiementModel->mode,
            telephone: $paiementModel->telephone,
            statut: $paiementModel->statut,
            datePaiement: $paiementModel->date_paiement
        );
    }

    /** @return Paiement[] */
    public static function toDomains(Collection $paiementModels): array 
    {
        return $paiementModels->map(function ($paiementModel) {
            return self::toDomain($paiementModel);
        })->all();
    }

}