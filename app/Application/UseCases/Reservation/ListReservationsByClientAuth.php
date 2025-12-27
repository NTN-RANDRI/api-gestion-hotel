<?php

namespace App\Application\UseCases\Reservation;

use App\Application\Mappers\ReservationMapper;
use App\Application\Services\CurrentAuthInterface;
use App\Domain\Repositories\ReservationRepositoryInterface;


class ListReservationsByClientAuth
{

    public function __construct(
        private ReservationRepositoryInterface $reservationRepo,
        private CurrentAuthInterface $currentAuth,
    )
    {}

    /** @return \App\Application\DTOs\Reservation\ReservationOutputDTO[] */
    public function execute(): array 
    {
        if ($this->currentAuth->role() === 'Personnel') {
            abort(403, 'Action non autorisée pour le personnel');
        }

        $reservations = $this->reservationRepo->findByClientId($this->currentAuth->userableId());

        return ReservationMapper::toDTOs($reservations);
    }

}