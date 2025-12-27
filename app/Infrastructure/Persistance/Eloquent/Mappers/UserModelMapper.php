<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\User;
use App\Models\User as UserModel;

class UserModelMapper
{

    public static function toArray(User $user): array
    {
        return [
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
        ];
    }

    public static function toDomain(UserModel $userModel): User
    {
        return new User(
            id: $userModel->id,
            email: $userModel->email,
            password: $userModel->password,
        );
    }

}