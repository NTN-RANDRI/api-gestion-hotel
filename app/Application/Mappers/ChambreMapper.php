<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Chambre\ChambreInputDTO;
use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;
use App\Domain\Entities\Chambre;
use App\Domain\Entities\TypeChambre;

class ChambreMapper
{

    public static function toDomain(ChambreInputDTO $inputDTO, TypeChambre $typeChambre): Chambre
    {
        return new Chambre(
            id: null,
            numero: $inputDTO->numero,
            prixNuit: $inputDTO->prixNuit,
            description: $inputDTO->description,
            typeChambre: $typeChambre
        );
    }

    public static function toDTO(Chambre $entity): ChambreOutputDTO
    {
        $typeChambre = $entity->getTypeChambre();

        return new ChambreOutputDTO(
            id: $entity->getId(),
            numero: $entity->getNumero(),
            prixNuit: $entity->getPrixNuit(),
            description: $entity->getDescription(),
            typeChambre: new TypeChambreOutputDTO(
                id: $typeChambre->getId(),
                nom: $typeChambre->getNom(),
                nombreLits: $typeChambre->getNombreLits(),
                capaciteMax: $typeChambre->getCapaciteMax(),
                description: $typeChambre->getDescription()
            )
        );
    }

}