<?php

namespace App\Http\Mappers;

use App\Application\DTOs\Client\ClientInputDTO;

class ClientHttpMapper
{

    public static function toDTO(array $data): ClientInputDTO
    {
        return new ClientInputDTO(
            nom: $data['nom'],
            prenom: $data['prenom'],
            telephone: $data['telephone'],
            cin: $data['cin']
        );
    }

}