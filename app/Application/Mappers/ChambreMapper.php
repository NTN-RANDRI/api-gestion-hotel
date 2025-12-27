<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Chambre\ChambreInputDTO;
use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Domain\Entities\Chambre;
use App\Domain\Entities\Equipement;
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
            typeChambre: $typeChambre,
        );
    }

    public static function toDTO(Chambre $chambre): ChambreOutputDTO
    {
        $typeChambreOutput = TypeChambreMapper::toDTO($chambre->getTypeChambre());

        $equipementOutputs = array_map(function (Equipement $equipement) {
            return EquipementMapper::toDTO($equipement);
        }, $chambre->getEquipements());

        $imageDTOs = array_map(function ($image) {
            return ImageMapper::toDTO($image);
        }, $chambre->getImages());

        return new ChambreOutputDTO(
            id: $chambre->getId(),
            numero: $chambre->getNumero(),
            prixNuit: $chambre->getPrixNuit(),
            description: $chambre->getDescription(),
            typeChambre: $typeChambreOutput,
            equipements: $equipementOutputs,
            images: $imageDTOs,
            statut: $chambre->getStatut(),
        );
    }

    /** 
     * @param \App\Domain\Entities\Chambre[] $chambres
     * @return \App\Application\DTOs\Chambre\ChambreOutputDTO[]
     */
    public static function toDTOs(array $chambres): array
    {
        $chambreOutputs = array_map(fn($chambre) => self::toDTO($chambre), $chambres);

        return $chambreOutputs;
    }

}