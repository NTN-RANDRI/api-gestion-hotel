<?php

namespace App\Application\UseCases\Reservation;

use App\Application\DTOs\Reservation\ReservationOutputDTO;
use App\Application\Mappers\ReservationMapper;
use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class GetReservationById
{

    public function __construct(
        private ReservationRepositoryInterface $reservationRepositoryInterface
    )
    {}

    public function execute(int $id): ReservationOutputDTO
    {
        $reservation = $this->reservationRepositoryInterface->find($id);
        if (!$reservation)  throw new EntityNotFoundException('Reservation');

        return ReservationMapper::toDTO($reservation);
    }

}