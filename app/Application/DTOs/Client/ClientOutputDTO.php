<?php

namespace App\Application\DTOs\Client;

use App\Application\DTOs\User\UserOutputDTO;

class ClientOutputDTO
{
    
    public function __construct(
        public int $id,
        public string $nom,
        public string $prenom,
        public string $telephone,
        public string $cin,
        public ?UserOutputDTO $user,
    )
    {}

}