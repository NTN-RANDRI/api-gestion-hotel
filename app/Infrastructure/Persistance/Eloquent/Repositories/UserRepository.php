<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryInterface;
use App\Models\User as UserModel;

class UserRepository implements UserRepositoryInterface
{

    public function findByEmail(string $email): ?User
    {
        $user = UserModel::where('email', $email)->first();
        if (!$user) return null;

        return new User($user->id, $user->email, $user->password);
    }

    public function save(User $user): User
    {
        throw new \Exception('Not implemented');
    }

}