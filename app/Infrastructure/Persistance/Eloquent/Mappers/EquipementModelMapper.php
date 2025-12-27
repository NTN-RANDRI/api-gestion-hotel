<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Equipement;
use App\Models\Equipement as EquipementModel;
use Illuminate\Database\Eloquent\Collection;

class EquipementModelMapper
{

    public static function toArray(Equipement $entity): array
    {
        return [
            'nom' => $entity->getNom(),
            'description' => $entity->getDescription(),
        ];
    }

    public static function toDomain(EquipementModel $model): Equipement
    {
        return new Equipement(
            id: $model->id,
            nom: $model->nom,
            description: $model->description,
        );
    }

    public static function toDomains(Collection $models): array
    {
        return $models->map(function ($model) {
            return self::toDomain($model);
        })->all();
    }

}