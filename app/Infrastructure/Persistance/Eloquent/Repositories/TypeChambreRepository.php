<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\TypeChambre;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\ChambreModelMapper;
use App\Infrastructure\Persistance\Eloquent\Mappers\TypeChambreModelMapper;
use App\Models\TypeChambre as TypeChambreModel;

class TypeChambreRepository implements TypeChambreRepositoryInterface
{

    public function all(): array
    {
        $models = TypeChambreModel::all();

        $typeChambres = $models->map(fn($model) => TypeChambreModelMapper::toDomain($model))->all();

        return $typeChambres;
    }

    public function find(int $id): ?TypeChambre
    {
        $model = TypeChambreModel::find($id);
        if (!$model) return null;

        $typeChambre = TypeChambreModelMapper::toDomain($model);

        return $typeChambre;
    }

    public function save(TypeChambre $entity): TypeChambre
    {
        $id = $entity->getId();

        if ($id) {
            $model = TypeChambreModel::find($id);
            $model->update(TypeChambreModelMapper::toArray($entity));
        } else {
            $model = TypeChambreModel::create(TypeChambreModelMapper::toArray($entity))->fresh();
        }

        return TypeChambreModelMapper::toDomain($model);
    }

    public function delete(int $id): void
    {
        $model = TypeChambreModel::find($id);
        $model->delete();
    }

}