<?php

namespace App\Application\DTOs\User;

class UserInputDTO
{

    public function __construct(
        public string $email,
        public string $password,
    )
    {}

}