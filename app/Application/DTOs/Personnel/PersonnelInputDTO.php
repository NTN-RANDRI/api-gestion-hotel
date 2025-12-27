<?php

namespace App\Application\DTOs\Personnel;

class PersonnelInputDTO
{

    public function __construct(
        public string $nom,
        public string $prenom,
        public string $telephone,
        public string $role,
    )
    {}

}