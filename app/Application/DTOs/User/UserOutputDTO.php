<?php

namespace App\Application\DTOs\User;

Class UserOutputDTO
{

    public function __construct(
        public int $id,
        public string $email,
    )
    {}

}