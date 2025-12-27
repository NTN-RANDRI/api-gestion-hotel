<?php

namespace App\Http\Mappers;

use App\Application\DTOs\Personnel\PersonnelInputDTO;

class PersonnelHttpMapper
{

    public static function toDTO(array $data): PersonnelInputDTO
    {
        return new PersonnelInputDTO(
            nom: $data['nom'],
            prenom: $data['prenom'],
            telephone: $data['telephone'],
            role: $data['role']
        );
    }

}