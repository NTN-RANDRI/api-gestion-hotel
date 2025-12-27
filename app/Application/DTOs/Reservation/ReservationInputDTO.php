<?php 

namespace App\Application\DTOs\Reservation;

class ReservationInputDTO
{
    /**
     * @param array<int, int> $chambreIds
     */
    public function __construct(
        public string $dateDebut,
        public string $dateFin,
        public int $nombrePersonnes,
        public string $type,
        public array $chambreIds,
        public ?int $clientId = null,
    )
    {}

}
