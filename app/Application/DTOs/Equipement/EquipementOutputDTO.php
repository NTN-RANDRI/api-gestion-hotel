<?php

namespace App\Application\DTOs\Equipement;

class EquipementOutputDTO
{

    public function __construct(
        public int $id,
        public string $nom,
        public ?string $description
    )
    {}

}