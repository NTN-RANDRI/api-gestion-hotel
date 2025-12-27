<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Personnel;
use App\Models\Personnel as PersonnelModel;
use Illuminate\Database\Eloquent\Collection;

class PersonnelModelMapper
{

    public static function toArray(Personnel $personnel): array
    {
        return [
            'nom' => $personnel->getNom(),
            'prenom' => $personnel->getPrenom(),
            'telephone' => $personnel->getTelephone(),
            'role' => $personnel->getRole(),
        ];
    }

    public static function toDomain(PersonnelModel $model): Personnel
    {
        return new Personnel(
            id: $model->id,
            nom: $model->nom,
            prenom: $model->prenom,
            telephone: $model->telephone,
            role: $model->role,
            user: $model->user ? UserModelMapper::toDomain($model->user) : null,
        );
    }

    public static function toDomains(Collection $models): array
    {
        return $models->map(function ($model) {
            return self::toDomain($model);
        })->all();
    }

}