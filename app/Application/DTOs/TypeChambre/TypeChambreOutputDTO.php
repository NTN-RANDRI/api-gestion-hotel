<?php

namespace App\Application\DTOs\TypeChambre;

class TypeChambreOutputDTO
{

    public function __construct(
        public int $id,
        public string $nom,
        public int $nombreLits,
        public int $capaciteMax,
        public ?string $description
    )
    {}

}