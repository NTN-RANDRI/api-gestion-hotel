<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\TypeChambre;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\TypeChambreMapper;
use App\Models\TypeChambre as TypeChambreModel;

class TypeChambreRepository implements TypeChambreRepositoryInterface
{

    public function all(): array
    {
        $models = TypeChambreModel::all();
        $entityArray = $models->map(fn ($model) => TypeChambreMapper::toDomain($model))->all();

        return $entityArray;
    }

    public function find(int $id): ?TypeChambre
    {
        $model = TypeChambreModel::find($id);

        return $model ? TypeChambreMapper::toDomain($model) : null;
    }

    public function save(TypeChambre $entity): TypeChambre
    {
        $id = $entity->getId();

        if ($id) {
            $model = TypeChambreModel::find($id);
            $model->update(TypeChambreMapper::toArray($entity));
        } else {
            $model = TypeChambreModel::create(TypeChambreMapper::toArray($entity));
        }

        return TypeChambreMapper::toDomain($model);
    }

    public function delete(int $id): void
    {
        $model = TypeChambreModel::find($id);
        $model->delete();
    }

}