<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Chambre;
use App\Domain\Entities\Equipement;
use App\Domain\Entities\Image;
use App\Domain\Entities\TypeChambre;
use App\Models\Chambre as ChambreModel;
use App\Models\Image as ImageModel;
use App\Models\Equipement as EquipementModel;

class ChambreModelMapper
{

    public static function toArray(Chambre $entity): array
    {
        return [
            'numero' => $entity->getNumero(),
            'prix_nuit' => $entity->getPrixNuit(),
            'description' => $entity->getDescription(),
            'type_chambre_id' => $entity->getTypeChambre()->getId(),
        ];
    }

    // public static function toModel(Chambre $entity): ChambreModel
    // {
    //     return new ChambreModel([
    //         'id' => $entity->getId(),
    //         'numero' => $entity->getNumero(),
    //         'prix_nuit' => $entity->getPrixNuit(),
    //         'description' => $entity->getDescription(),
    //         'type_chambre_id' => $entity->getTypeChambre()->getId(),
    //         'equipements' => $entity->getEquipements()
    //     ]);
    // }

    public static function toDomain(ChambreModel $model): Chambre
    {
        $typeChambreModel = $model->typeChambre;

        $typeChambre = TypeChambreModelMapper::toDomain($typeChambreModel);

        $equipements = array_map(fn (EquipementModel $equipementModel) => EquipementModelMapper::toDomain($equipementModel), $model->equipements->all());

        $images = array_map(fn (ImageModel $imageModel) => ImageModelMapper::toDomain($imageModel), $model->images->all());

        return new Chambre(
            id: $model->id,
            numero: $model->numero,
            prixNuit: $model->prix_nuit,
            description: $model->description,
            typeChambre: $typeChambre,
            equipements: $equipements,
            images: $images
        );
    }

}