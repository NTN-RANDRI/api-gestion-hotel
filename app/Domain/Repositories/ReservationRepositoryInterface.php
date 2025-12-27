<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Paiement;
use App\Domain\Entities\Reservation;

interface ReservationRepositoryInterface
{
    /** @return \App\Domain\Entities\Reservation[] */
    public function all(): array;

    public function find(int $id): ?Reservation;

    public function findByIdAndClientId(int $id, int $clientId): ?Reservation;

    /** @return \App\Domain\Entities\Reservation[] */
    public function findByChambreId(int $chambreId): array;

    /** @return \App\Domain\Entities\Reservation[] */
    public function findByClientId(int $clientId): array;

    public function save(Reservation $entity): Reservation;

    public function delete(int $id): void;

    public function attachChambre(Reservation $reservation, int $chambreId): void;

    public function syncChambres(Reservation $reservation, array $chambreIds): void;
    
    public function createPaiement(Reservation $reservation, Paiement $paiement): Paiement;

    public function checkIn(int $reservationId): void;

    public function checkOut(int $reservationId): void;
}