<?php 

namespace App\Application\DTOs\Paiement;

class PaiementOutputDTO
{

    public function __construct(
        public int $id,
        public int $montant,
        public string $mode,
        public ?string $telephone = null,
        public string $statut,
        public string $datePaiement
    )
    {}

}