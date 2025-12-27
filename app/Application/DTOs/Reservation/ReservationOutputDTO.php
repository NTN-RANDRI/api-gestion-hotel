<?php

namespace App\Application\DTOs\Reservation;

use App\Application\DTOs\Client\ClientOutputDTO;

class ReservationOutputDTO
{

    /**
     *  @param \App\Application\DTOs\Chambre\ChambreOutputDTO[] $chambres 
     *  @param \App\Application\DTOs\Paiement\PaiementOutputDTO[] $paiements
     */
    public function __construct(
        public int $id,
        public string $dateDebut,
        public string $dateFin,
        public string $dateReservation,
        public int $nombrePersonnes,
        public int $montantTotal,
        public string $type,
        public ?string $statut,
        public ClientOutputDTO $client,
        public array $chambres,
        public array $paiements,
        public ?int $montantRestant = null,
        public ?string $dateArrivee = null,
        public ?string $dateDepart = null,
    )
    {}

}