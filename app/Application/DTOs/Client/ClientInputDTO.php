<?php

namespace App\Application\DTOs\Client;

class ClientInputDTO
{

    public function __construct(
        public string $nom,
        public string $prenom,
        public string $telephone,
        public string $cin
    )
    {}

}