<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\Chambre;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\ChambreMapper;
use App\Models\Chambre as ChambreModel;

class ChambreRepository implements ChambreRepositoryInterface
{

    public function all(): array
    {
        $models = ChambreModel::all();
        $entityArray = $models->map(fn ($model) => ChambreMapper::toDomain($model))->all();

        return $entityArray;
    }

    public function find(int $id): ?Chambre
    {
        $model = ChambreModel::find($id);

        return $model ? ChambreMapper::toDomain($model) : null;
    }

    public function save(Chambre $entity): Chambre
    {
        $id = $entity->getId();

        if ($id) {
            $model = ChambreModel::find($id);
            $model->update(ChambreMapper::toArray($entity));
        } else {
            $model = ChambreModel::create(ChambreMapper::toArray($entity));
        }

        return ChambreMapper::toDomain($model);
    }

    public function delete(int $id): void
    {
        $model = ChambreModel::find($id);
        $model->delete();
    }

}