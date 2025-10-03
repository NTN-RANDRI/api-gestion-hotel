<?php

namespace App\Infrastructure\Persistance\Eloquent;

use App\Domain\Entities\Equipement;
use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Models\Equipement as EquipementModel;

class EquipementRepository implements EquipementRepositoryInterface
{

    public function all(): array
    {
        $models = EquipementModel::all();

        $equipements = $models->map(fn ($model) => new Equipement(
            id: $model->id,
            nom: $model->nom,
            description: $model->description
        ))->all();

        return $equipements;
    }

    public function find(int $id): ?Equipement
    {
        $model = EquipementModel::find($id);

        if (!$model) {
            return null;
        }

        return new Equipement(
            $model->id,
            $model->nom,
            $model->description
        );
    }

    public function save(Equipement $equipement): Equipement
    {
        $id = $equipement->getId();

        if ($id) {
            $model = EquipementModel::find($id);

            $model->nom = $equipement->getNom();
            $model->description = $equipement->getDescription();
            $model->save();

            return new Equipement(
                $model->id,
                $model->nom,
                $model->description
            );
        } else {
            $newEquipement = EquipementModel::create([
                'nom' => $equipement->getNom(),
                'description' => $equipement->getDescription()
            ]);

            return new Equipement(
                $newEquipement->id,
                $newEquipement->nom,
                $newEquipement->description
            );
        }
    }

    public function delete(int $id): void
    {
        $model = EquipementModel::find($id);

        $model->delete();
    }

}