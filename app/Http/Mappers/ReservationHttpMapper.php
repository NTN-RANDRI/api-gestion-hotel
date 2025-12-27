<?php

namespace App\Http\Mappers;

use App\Application\DTOs\Reservation\ReservationInputDTO;
use App\Application\DTOs\Reservation\UpdateReservationInputDTO;

class ReservationHttpMapper
{

    public static function toDTO(array $data): ReservationInputDTO
    {
        return new ReservationInputDTO(
            dateDebut: $data['date_debut'],
            dateFin: $data['date_fin'],
            nombrePersonnes: $data['nombre_personnes'],
            type: $data['type'],
            chambreIds: $data['chambre_ids']
        );
    }

    public static function toUpdateDTO(array $data): UpdateReservationInputDTO
    {
        return new UpdateReservationInputDTO(
            dateDebut: $data['date_debut'],
            dateFin: $data['date_fin'],
            nombrePersonnes: $data['nombre_personnes'],
            chambreIds: $data['chambre_ids']
        );
    }

}