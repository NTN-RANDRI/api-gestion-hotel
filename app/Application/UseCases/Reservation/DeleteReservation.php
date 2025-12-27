<?php

namespace App\Application\UseCases\Reservation;

use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class DeleteReservation
{

    public function __construct(
        private ReservationRepositoryInterface $reservationRepositoryInterface
    )
    {}

    public function execute(int $id): void
    {
        $reservation = $this->reservationRepositoryInterface->find($id);

        if (!$reservation) {
            throw new EntityNotFoundException('Reservation'); 
        }

        $this->reservationRepositoryInterface->delete($reservation->getId());
    }

}