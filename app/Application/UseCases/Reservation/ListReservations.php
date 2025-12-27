<?php

namespace App\Application\UseCases\Reservation;

use App\Application\Mappers\ReservationMapper;
use App\Domain\Repositories\ReservationRepositoryInterface;

class ListReservations
{

    public function __construct(
        private ReservationRepositoryInterface $reservationRepositoryInterface
    )
    {}

    public function execute(): array
    {
        $reservations = $this->reservationRepositoryInterface->all();

        return ReservationMapper::toDTOs($reservations);
    }

}