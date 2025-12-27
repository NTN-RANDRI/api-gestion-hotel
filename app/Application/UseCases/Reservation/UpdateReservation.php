<?php

namespace App\Application\UseCases\Reservation;

use App\Application\DTOs\Reservation\UpdateReservationInputDTO;
use App\Application\Mappers\ReservationMapper;
use App\Domain\Entities\Reservation;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class UpdateReservation
{

    public function __construct (
        private ReservationRepositoryInterface $reservationRepo,
        private ChambreRepositoryInterface $chambreRepo,
    ) {}

    public function execute(int $reservationId, UpdateReservationInputDTO $updateReservationInput): mixed
    {
        $chambres = $this->loadChambresInChambreRepo($updateReservationInput->chambreIds);

        $reservation = $this->loadReservationInRepo($reservationId);

        $reservation->setDateDebut($updateReservationInput->dateDebut);
        $reservation->setDateFin($updateReservationInput->dateFin);
        $reservation->updateChambres($chambres);
        $reservation->calculMontantTotal();

        $reservation = $this->reservationRepo->save($reservation);
        $this->reservationRepo->syncChambres($reservation, $updateReservationInput->chambreIds);

        return ReservationMapper::toDTO($reservation);
    }

    private function loadReservationInRepo(int $reservationId): Reservation
    {
        $reservation = $this->reservationRepo->find($reservationId);
        if (!$reservation) throw new EntityNotFoundException('Reservation');

        return $reservation;
    }

    private function loadChambresInChambreRepo(array $chambreIds): array
    {
        $chambres = [];
        foreach ($chambreIds as $chambreId) {
            $chambre = $this->chambreRepo->find($chambreId);
            if (!$chambre) { throw new EntityNotFoundException('Chambre'); }

            $chambres[] = $chambre;
        }

        return $chambres;
    }

}