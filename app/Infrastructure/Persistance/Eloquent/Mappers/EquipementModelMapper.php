<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Equipement;
use App\Models\Equipement as EquipementModel;

class EquipementModelMapper
{

    public static function toArray(Equipement $entity): array
    {
        return [
            'nom' => $entity->getNom(),
            'description' => $entity->getDescription(),
        ];
    }

    // public static function toModel(Equipement $entity): EquipementModel
    // {
    //     return new EquipementModel([
    //         'id' => $entity->getId(),
    //         'nom' => $entity->getNom(),
    //         'description' => $entity->getDescription(),
    //     ]);
    // }

    public static function toDomain(EquipementModel $model): Equipement
    {
        return new Equipement(
            id: $model->id,
            nom: $model->nom,
            description: $model->description
        );
    }

}