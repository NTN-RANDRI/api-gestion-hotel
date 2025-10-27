<?php

namespace App\Application\DTOs\Chambre;

use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;

class ChambreOutputDTO
{

    public function __construct(
        public int $id,
        public string $numero,
        public int $prixNuit,
        public ?string $description,
        public TypeChambreOutputDTO $typeChambre,
        public array $equipements,
        public array $images
    )
    {}

}