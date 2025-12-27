<?php

namespace App\Application\Mappers;

use App\Application\DTOs\User\UserInputDTO;
use App\Application\DTOs\User\UserOutputDTO;
use App\Domain\Entities\User;

class UserMapper
{

    public static function toDomain(UserInputDTO $userInput): User
    {
        return new User(
            id: null,
            email: $userInput->email,
            password: $userInput->password,
        );
    }

    public static function toDTO(User $user): UserOutputDTO
    {
        return new UserOutputDTO(
            id: $user->getId(),
            email: $user->getEmail(),
        );
    }

}