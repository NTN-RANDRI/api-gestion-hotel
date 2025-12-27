<?php

namespace App\Application\UseCases\Reservation;

use App\Application\DTOs\Reservation\ReservationOutputDTO;
use App\Application\Mappers\ReservationMapper;
use App\Domain\Entities\Reservation;
use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class CheckInReservation
{

    public function __construct(
        private ReservationRepositoryInterface $reservationRepo,
    )
    {}

    public function execute(int $reservationId): ReservationOutputDTO 
    {
        $reservation = $this->loadReservationInRepo($reservationId);

        $reservation->checkIn();

        $this->reservationRepo->checkIn($reservationId);

        return ReservationMapper::toDTO($reservation);
    }

    private function loadReservationInRepo(int $id): Reservation {
        $reservation = $this->reservationRepo->find($id);
        if (!$reservation) throw new EntityNotFoundException('Reservation');

        return $reservation;
    }

}