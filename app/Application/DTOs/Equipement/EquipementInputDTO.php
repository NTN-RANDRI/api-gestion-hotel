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

    public function toEquipement(): Equipement
    {
        return new Equipement(
            null,
            $this->nom,
            $this->description
        );
    }

}