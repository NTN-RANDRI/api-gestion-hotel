<?php

namespace App\Application\DTOs\Personnel;

use App\Application\DTOs\User\UserOutputDTO;

class PersonnelOutputDTO
{

    public function __construct(
        public int $id,
        public string $nom,
        public string $prenom,
        public string $telephone,
        public string $role,
        public ?UserOutputDTO $user = null,
    )
    {}

}