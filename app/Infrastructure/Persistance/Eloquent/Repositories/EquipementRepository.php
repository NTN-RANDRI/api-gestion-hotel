<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\Equipement;
use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\EquipementMapper;
use App\Models\Equipement as EquipementModel;

class EquipementRepository implements EquipementRepositoryInterface
{

    public function all(): array
    {
        $models = EquipementModel::all();
        $equipements = $models->map(fn ($model) => EquipementMapper::toDomain($model))->all();

        return $equipements;
    }

    public function find(int $id): ?Equipement
    {
        $model = EquipementModel::find($id);

        return $model ? EquipementMapper::toDomain($model) : null;
    }

    public function save(Equipement $equipement): Equipement
    {
        $id = $equipement->getId();

        if ($id) {
            $model = EquipementModel::find($id);
            $model->update(EquipementMapper::toArray($equipement)); 
        } else {
            $model = EquipementModel::create(EquipementMapper::toArray($equipement));
        }

        return EquipementMapper::toDomain($model);
    }

    public function delete(int $id): void
    {
        $model = EquipementModel::find($id);
        $model->delete();
    }

}