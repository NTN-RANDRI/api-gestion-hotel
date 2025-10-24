<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Chambre\ChambreInputDTO;
use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\DTOs\Equipement\EquipementOutputDTO;
use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;
use App\Domain\Entities\Chambre;
use App\Domain\Entities\Equipement;
use App\Domain\Entities\TypeChambre;

class ChambreMapper
{

    public static function toDomain(ChambreInputDTO $inputDTO, TypeChambre $typeChambre, array $equipements): Chambre
    {
        return new Chambre(
            id: null,
            numero: $inputDTO->numero,
            prixNuit: $inputDTO->prixNuit,
            description: $inputDTO->description,
            typeChambre: $typeChambre,
            equipements: $equipements,
        );
    }

    public static function toDTO(Chambre $entity): ChambreOutputDTO
    {
        $typeChambre = $entity->getTypeChambre();

        $equipementsDTO = array_map(fn($e) => new EquipementOutputDTO(
            id: $e->getId(),
            nom: $e->getNom(),
            description: $e->getDescription()
        ), $entity->getEquipements());

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
            ),
            equipements: $equipementsDTO,
        );
    }

}