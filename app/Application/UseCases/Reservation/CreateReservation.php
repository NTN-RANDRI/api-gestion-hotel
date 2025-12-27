<?php

namespace App\Application\UseCases\Reservation;

use App\Application\DTOs\Client\ClientInputDTO;
use App\Application\DTOs\Client\ClientOutputDTO;
use App\Application\DTOs\Paiement\PaiementInputDTO;
use App\Application\DTOs\Reservation\ReservationInputDTO;
use App\Application\DTOs\Reservation\ReservationOutputDTO;
use App\Application\Mappers\ClientMapper;
use App\Application\Mappers\PaiementMapper;
use App\Application\Mappers\ReservationMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class CreateReservation
{

    public function __construct(
        private ReservationRepositoryInterface $reservationRepo,
        private ClientRepositoryInterface $clientRepo,
        private ChambreRepositoryInterface $chambreRepo,
    )
    {}

    public function execute(ClientInputDTO|ClientOutputDTO $clientDTO, ReservationInputDTO $reservationInput, PaiementInputDTO $paiementInput): ReservationOutputDTO
    {
        $chambresIds = $reservationInput->chambreIds;

        // 1) client
        if ($reservationInput->type === 'en_ligne') {
            $client = $this->clientRepo->find($clientDTO->id);
        } else {
            $client = $this->clientRepo->save(ClientMapper::toDomain($clientDTO));
        }
        
        // 2) reservation
        $chambres = $this->loadChambresInChambreRepo($chambresIds);

        $newReservation = ReservationMapper::toDomain($reservationInput, $client);

        $newReservation->addManyChambres($chambres);
        $newReservation->calculMontantTotal();

        $reservation = $this->reservationRepo->save($newReservation);
        $this->reservationRepo->syncChambres($reservation, $chambresIds);

        $reservation->addManyChambres($chambres);

        // 3) paiement
        $paiement = $this->reservationRepo->createPaiement($reservation, PaiementMapper::toDomain($paiementInput, $reservation));

        $reservation->addPaiement($paiement);

        return ReservationMapper::toDTO($reservation);
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
