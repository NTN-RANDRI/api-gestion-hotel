<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\Paiement;
use App\Domain\Entities\Reservation;
use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\PaiementModelMapper;
use App\Infrastructure\Persistance\Eloquent\Mappers\ReservationModelMapper;
use App\Models\Reservation as ReservationModel;
use App\Models\Chambre as ChambreModel;
use App\Models\Client as ClientModel;
 
class ReservationRepository implements ReservationRepositoryInterface
{

    public function all(): array
    {
        $reservationModels = ReservationModel::all();

        $reservations = array_map(fn (ReservationModel $reservationModel) => 
            ReservationModelMapper::toDomain($reservationModel)
        , $reservationModels->all());

        return $reservations;
    }

    public function find(int $id): ?Reservation
    {
        $reservationModel = ReservationModel::find($id);
        if (!$reservationModel) return null;

        $reservation = ReservationModelMapper::toDomain($reservationModel);

        return $reservation;
    }

    public function findByIdAndClientId(int $id, int $clientId): ?Reservation
    {
        $reservationModel = ReservationModel::where('id', $id)
            ->where('client_id', $clientId)
            ->first();

        if (!$reservationModel) return null;

        $reservation = ReservationModelMapper::toDomain($reservationModel);

        return $reservation;
    }

    public function findByChambreId(int $chambreId): array
    {
        $reservationModels = ChambreModel::find($chambreId)->reservations;

        $reservations = array_map(fn (ReservationModel $reservationModel) => 
            ReservationModelMapper::toDomain($reservationModel)
        , $reservationModels->all());

        return $reservations;
    }

    public function findByClientId(int $clientId): array
    {
        $reservationModels = ClientModel::find($clientId)->reservations;

        $reservations = array_map(fn (ReservationModel $reservationModel) => 
            ReservationModelMapper::toDomain($reservationModel)
        , $reservationModels->all());

        return $reservations;
    }

    public function save(Reservation $entity): Reservation
    {
        $id = $entity->getId();

        if ($id) {
            $reservationModel = ReservationModel::find($id);
            $reservationModel->update(ReservationModelMapper::toArray($entity));

            $reservation = ReservationModelMapper::toDomain($reservationModel);
        } else {
            $reservationModel = ReservationModel::create(ReservationModelMapper::toArray($entity))->fresh();

            $reservation = ReservationModelMapper::toDomain($reservationModel);
        }

        return $reservation;
    }

    public function delete(int $id): void
    {
        $reservationModel = ReservationModel::find($id);
        $reservationModel->delete();
    }

    public function attachChambre(Reservation $reservation, int $chambreId): void
    {
        $reservationModel = ReservationModel::find($reservation->getId());
        $reservationModel->chambres()->attach($chambreId);
    }
    
    public function syncChambres(Reservation $reservation, array $chambreIds): void
    {
        $reservationModel = ReservationModel::find($reservation->getId());
        $reservationModel->chambres()->sync($chambreIds);
    }

    public function createPaiement(Reservation $reservation, Paiement $paiement): Paiement
    {
        $reservationModel = ReservationModel::find($reservation->getId());
        $paiementModel = $reservationModel->paiements()->create(PaiementModelMapper::toArray($paiement))->fresh();
        
        return PaiementModelMapper::toDomain($paiementModel);
    }

    public function checkIn(int $reservationId): void
    {
        $reservationModel = ReservationModel::find($reservationId);
        $reservationModel->date_arrivee = now();
        $reservationModel->save();
    }

    public function checkOut(int $reservationId): void
    {
        $reservationModel = ReservationModel::find($reservationId);
        $reservationModel->date_depart = now();
        $reservationModel->save();
    }

}