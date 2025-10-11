<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\Chambre;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\ChambreModelMapper;
use App\Models\Chambre as ChambreModel;

class ChambreRepository implements ChambreRepositoryInterface
{

    public function all(): array
    {
        $models = ChambreModel::all();
        $entityArray = $models->map(fn ($model) => ChambreModelMapper::toDomain($model))->all();

        return $entityArray;
    }

    public function find(int $id): ?Chambre
    {
        $model = ChambreModel::find($id);

        return $model ? ChambreModelMapper::toDomain($model) : null;
    }

    public function save(Chambre $entity): Chambre
    {
        $id = $entity->getId();

        if ($id) {
            $model = ChambreModel::find($id);
            $model->update(ChambreModelMapper::toArray($entity));
        } else {
            $model = ChambreModel::create(ChambreModelMapper::toArray($entity));
        }

        return ChambreModelMapper::toDomain($model);
    }

    public function delete(int $id): void
    {
        $model = ChambreModel::find($id);
        $model->delete();
    }

}