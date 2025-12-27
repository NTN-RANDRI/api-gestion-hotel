<?php

namespace App\Http\Mappers;

use App\Application\DTOs\User\UserInputDTO;

class UserHttpMapper
{

    public static function toDTO(array $data): UserInputDTO
    {
        return new UserInputDTO(
            email: $data['email'],
            password: $data['password'],
        );
    }

}