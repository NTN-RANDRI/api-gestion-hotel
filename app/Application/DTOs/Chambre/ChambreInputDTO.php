<?php

namespace App\Application\DTOs\Chambre;

class ChambreInputDTO
{

    public function __construct(
        public string $numero,
        public int $prixNuit,
        public ?string $description,
        public int $typeChambreId
    )
    {}

}