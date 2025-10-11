<?php

namespace App\Application\Mappers;

use App\Application\DTOs\TypeChambre\TypeChambreInputDTO;
use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;
use App\Domain\Entities\TypeChambre;

class TypeChambreMapper
{

    public static function toDomain(TypeChambreInputDTO $inputDTO): TypeChambre
    {
        return new TypeChambre(
            id: null,
            nom: $inputDTO->nom,
            nombreLits: $inputDTO->nombreLits,
            capaciteMax: $inputDTO->capaciteMax,
            description: $inputDTO->description
        );
    }

    public static function toDTO(TypeChambre $entity): TypeChambreOutputDTO
    {
        return new TypeChambreOutputDTO(
            id: $entity->getId(),
            nom: $entity->getNom(),
            nombreLits: $entity->getNombreLits(),
            capaciteMax: $entity->getCapaciteMax(),
            description: $entity->getDescription()
        );
    }

}