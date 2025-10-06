<?php

namespace App\Application\DTOs\Equipement;

class EquipementInputDTO
{

    public function __construct(
        public string $nom,
        public ?string $description
    )
    {}

}