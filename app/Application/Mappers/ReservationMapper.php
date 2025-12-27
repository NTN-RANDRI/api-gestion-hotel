<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Reservation\ReservationInputDTO;
use App\Application\DTOs\Reservation\ReservationOutputDTO;
use App\Domain\Entities\Client;
use App\Domain\Entities\Reservation;
use App\Shared\Utils\DateFormatter;

class ReservationMapper
{
    /**
     *  @param array<int, \App\Domain\Entities\Chambre> $chambres 
     */
    public static function toDomain(ReservationInputDTO $reservationInput, Client $client): Reservation
    {
        return new Reservation(
            id: null,
            dateDebut: $reservationInput->dateDebut,
            dateFin: $reservationInput->dateFin,
            nombrePersonnes: $reservationInput->nombrePersonnes,
            type: $reservationInput->type,
            client: $client,
        );
    }

    public static function toDTO(Reservation $reservation): ReservationOutputDTO
    {
        $clientOutput = ClientMapper::toDTO($reservation->getClient());
        $chambreOutputs = ChambreMapper::toDTOs($reservation->getChambres());
        $paiementOutputs = PaiementMapper::toDTOs($reservation->getPaiements());

        return new ReservationOutputDTO(
            id: $reservation->getId(),
            dateDebut: DateFormatter::toIso8601($reservation->getDateDebut()),
            dateFin: DateFormatter::toIso8601($reservation->getDateFin()),
            dateReservation: DateFormatter::toIso8601($reservation->getDateReservation()),
            nombrePersonnes: $reservation->getNombrePersonnes(),
            montantTotal: $reservation->getMontantTotal(),
            type: $reservation->getType(),
            statut: $reservation->getStatut(),
            client: $clientOutput,
            chambres: $chambreOutputs,
            paiements: $paiementOutputs,
            montantRestant: $reservation->getMontantRestant(),
            dateArrivee: $reservation->getDateArrivee(),
            dateDepart: $reservation->getDateDepart(),
        );
    }

    public static function toDTOs(array $reservations): array
    {
        return array_map(fn($reservation) => self::toDTO($reservation), $reservations);
    }

}