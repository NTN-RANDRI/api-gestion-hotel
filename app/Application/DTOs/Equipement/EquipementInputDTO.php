<?php

namespace App\Application\DTOs\Equipement;

use App\Domain\Entities\Equipement;

class EquipementInputDTO
{

    public function __construct(
        public string $nom,
        public ?string $description
    )
    {}

}