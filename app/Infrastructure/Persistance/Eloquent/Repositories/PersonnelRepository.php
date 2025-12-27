<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\Personnel;
use App\Domain\Entities\User;
use App\Domain\Repositories\PersonnelRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\PersonnelModelMapper;
use App\Infrastructure\Persistance\Eloquent\Mappers\UserModelMapper;
use App\Models\Personnel as PersonneltModel;

class PersonnelRepository implements PersonnelRepositoryInterface
{

    public function all(): array
    {
        $models = PersonneltModel::all();

        $personnels = PersonnelModelMapper::toDomains($models);

        return $personnels;
    }

    public function find(int $id): ?Personnel
    {
        $model = PersonneltModel::find($id);

        return $model ? PersonnelModelMapper::toDomain($model) : null;
    }

    public function save(Personnel $personnel): Personnel
    {
        $id = $personnel->getId();

        if ($id) {
            $model = PersonneltModel::find($id);
            $model->update(PersonnelModelMapper::toArray($personnel));
        } else {
            $model = PersonneltModel::create(PersonnelModelMapper::toArray($personnel));
        }

        return PersonnelModelMapper::toDomain($model);
    }

    public function delete(int $id): void
    {
        $model = PersonneltModel::find($id);
        $model->delete();
    }

    public function createUser(int $id, User $user): User
    {
        $model = PersonneltModel::find($id);
        $userModel = $model->user()->create(UserModelMapper::toArray($user));

        return UserModelMapper::toDomain($userModel);
    }

}