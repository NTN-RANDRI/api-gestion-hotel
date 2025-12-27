<?php 

namespace App\Application\DTOs\Reservation;

class UpdateReservationInputDTO
{

    /**
     * @param array<int, int> $chambreIds
     */
    public function __construct(
        public string $dateDebut,
        public string $dateFin,
        public int $nombrePersonnes,
        public array $chambreIds,
    )
    {}

}