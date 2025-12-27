<?php 

namespace App\Application\UseCases\Reservation;

use App\Application\DTOs\Paiement\PaiementInputDTO;
use App\Application\DTOs\Reservation\ReservationOutputDTO;
use App\Application\Mappers\PaiementMapper;
use App\Application\Mappers\ReservationMapper;
use App\Domain\Entities\Reservation;
use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class CreatePaiementReservation
{

    public function __construct(
        private ReservationRepositoryInterface $reservationRepo,
    )
    {}

    public function execute(int $reservationId, PaiementInputDTO $paiementInput): ReservationOutputDTO
    {
        $reservation = $this->loadReservation($reservationId);

        $paiement = $this->reservationRepo->createPaiement($reservation, PaiementMapper::toDomain($paiementInput));

        $reservation->addPaiement($paiement);

        return ReservationMapper::toDTO($reservation);
    }

    private function loadReservation(int $reservationId): Reservation
    {
        $reservation = $this->reservationRepo->find($reservationId);
        if (!$reservation) throw new EntityNotFoundException('Reservation');

        return $reservation;
    }

}