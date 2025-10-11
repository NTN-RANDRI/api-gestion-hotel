<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Equipement\EquipementInputDTO;
use App\Application\DTOs\Equipement\EquipementOutputDTO;
use App\Domain\Entities\Equipement;

class EquipementMapper
{

    public static function toDomain(EquipementInputDTO $inputDTO): Equipement
    {
        return new Equipement(
            id: null,
            nom: $inputDTO->nom,
            description: $inputDTO->description
        );
    }

    public static function toDTO(Equipement $entity): EquipementOutputDTO
    {
        return new EquipementOutputDTO(
            id: $entity->getId(),
            nom: $entity->getNom(),
            description: $entity->getDescription()
        );
    }

}