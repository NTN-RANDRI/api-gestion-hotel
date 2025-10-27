<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Chambre\ChambreInputDTO;
use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\DTOs\Equipement\EquipementOutputDTO;
use App\Application\DTOs\Images\ImageOutputDTO;
use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;
use App\Domain\Entities\Chambre;
use App\Domain\Entities\Equipement;
use App\Domain\Entities\Image;
use App\Domain\Entities\TypeChambre;

class ChambreMapper
{

    public static function toDomain(ChambreInputDTO $inputDTO, TypeChambre $typeChambre, array $equipements): Chambre
    {
        $images = array_map(fn ($pathImage) => new Image(
            id: null,
            path: $pathImage
        ), $inputDTO->pathImages);

        return new Chambre(
            id: null,
            numero: $inputDTO->numero,
            prixNuit: $inputDTO->prixNuit,
            description: $inputDTO->description,
            typeChambre: $typeChambre,
            equipements: $equipements,
            images: $images
        );
    }

    public static function toDTO(Chambre $entity): ChambreOutputDTO
    {
        $typeChambre = $entity->getTypeChambre();

        $equipementsDTOs = array_map(fn(Equipement $e) => new EquipementOutputDTO(
            id: $e->getId(),
            nom: $e->getNom(),
            description: $e->getDescription()
        ), $entity->getEquipements());

        $imageDTOs = array_map(fn (Image $image) => new ImageOutputDTO(
            id: $image->getId(),
            url: $image->getUrl()
        ), $entity->getImages());

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
            equipements: $equipementsDTOs,
            images: $imageDTOs
        );
    }

}