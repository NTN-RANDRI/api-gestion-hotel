<?php

namespace App\Infrastructure\Services;

use App\Application\Services\TokenServiceInterface;
use App\Domain\Entities\User;
use App\Models\User as UserModel;

class TokenService implements TokenServiceInterface
{
    
    public function createToken(User $user): string
    {
        $userModel = UserModel::findOrFail($user->getId());
        
        $token = $userModel->createToken('api-token')->plainTextToken;

        return $token;
    }

}