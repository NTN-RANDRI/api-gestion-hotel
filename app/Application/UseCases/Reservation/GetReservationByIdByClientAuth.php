<?php

namespace App\Application\UseCases\Reservation;

use App\Application\DTOs\Reservation\ReservationOutputDTO;
use App\Application\Mappers\ReservationMapper;
use App\Application\Services\CurrentAuthInterface;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class GetReservationByIdByClientAuth
{

    public function __construct(
        private ReservationRepositoryInterface $reservationRepo,
        private CurrentAuthInterface $currentAuth,
    )
    {}

    public function execute(int $id): ReservationOutputDTO
    {
        if ($this->currentAuth->role() === 'Personnel') {
            abort(403, 'Action non autorisée pour le personnel');
        }

        $reservation = $this->reservationRepo->findByIdAndClientId($id, $this->currentAuth->userableId());
        if (!$reservation)  throw new EntityNotFoundException('Reservation');

        return ReservationMapper::toDTO($reservation);
    }

}