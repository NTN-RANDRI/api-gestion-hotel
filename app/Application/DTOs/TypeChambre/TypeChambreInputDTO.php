<?php

namespace App\Application\DTOs\TypeChambre;

class TypeChambreInputDTO
{

    public function __construct(
        public string $nom,
        public int $nombreLits,
        public int $capaciteMax,
        public ?string $description
    )
    {}

}