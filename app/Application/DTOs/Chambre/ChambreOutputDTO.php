<?php

namespace App\Application\DTOs\Chambre;

use App\Domain\Entities\TypeChambre;

class ChambreOutputDTO
{

    public function __construct(
        public int $id,
        public string $numero,
        public int $prixNuit,
        public ?string $description,
        public TypeChambre $typeChambre
    )
    {}

}