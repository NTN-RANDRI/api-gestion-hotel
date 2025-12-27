<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Reservation;
use App\Models\Reservation as ReservationModel;
use App\Models\Chambre as ChambreModel;
use Illuminate\Database\Eloquent\Collection;

class ReservationModelMapper
{

    public static function toArray(Reservation $reservation): array
    {
        return [
            'date_debut' => $reservation->getDateDebut(),
            'date_fin' =>  $reservation->getDateFin(),
            'nombre_personnes' => $reservation->getNombrePersonnes(),
            'montant_total' => $reservation->getMontantTotal(),
            'type' => $reservation->getType(),
            'client_id' => $reservation->getClient()->getId(),
        ];
    }

    public static function toDomain(ReservationModel $reservationModel): Reservation
    {
        $client = ClientModelMapper::toDomain($reservationModel->client);
        $chambres = ChambreModelMapper::toDomains($reservationModel->chambres);
        $paiements = PaiementModelMapper::toDomains($reservationModel->paiements);

        $reservation = new Reservation(
            id: $reservationModel->id,
            dateDebut: $reservationModel->date_debut,
            dateFin: $reservationModel->date_fin,
            dateReservation: $reservationModel->date_reservation,
            nombrePersonnes: $reservationModel->nombre_personnes,
            type: $reservationModel->type,
            client: $client,
            montantTotal: $reservationModel->montant_total,
            dateArrivee: $reservationModel->date_arrivee,
            dateDepart: $reservationModel->date_depart,
            chambres: $chambres,
            paiements: $paiements,
            annuler: $reservationModel->annuler,
            montantRestant: $reservationModel->montant_restant,
            statut: $reservationModel->statut,
        );

        return $reservation;
    }

    public static function toDomains(Collection $models): array
    {
        return $models->map(function ($model) {
            return self::toDomain($model);
        })->all();
    }

}