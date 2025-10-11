<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\TypeChambre;
use App\Models\TypeChambre as TypeChambreModel;

class TypeChambreModelMapper
{

    public static function toArray(TypeChambre $entity): array
    {
        return [
            'nom' => $entity->getNom(),
            'nombre_lits' => $entity->getNombreLits(),
            'capacite_max' => $entity->getCapaciteMax(),
            'description' => $entity->getDescription(),
        ];
    }

    public static function toModel(TypeChambre $entity): TypeChambreModel
    {
        return new TypeChambreModel([
            'id' => $entity->getId(),
            'nom' => $entity->getNom(),
            'nombre_lits' => $entity->getNombreLits(),
            'capacite_max' => $entity->getCapaciteMax(),
            'description' => $entity->getDescription(),
        ]);
    }

    public static function toDomain(TypeChambreModel $model): TypeChambre
    {
        return new TypeChambre(
            id: $model->id,
            nom: $model->nom,
            nombreLits: $model->nombre_lits,
            capaciteMax: $model->capacite_max,
            description: $model->description,
        );
    }

}