<?php 

namespace App\Application\DTOs\Paiement;

class PaiementInputDTO
{

    public function __construct(
        public int $montant,
        public string $mode,
        public ?string $telephone = null,
    )
    {}

}