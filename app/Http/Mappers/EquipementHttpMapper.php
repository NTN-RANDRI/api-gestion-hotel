<?php

namespace App\Http\Mappers;

use App\Application\DTOs\Equipement\EquipementInputDTO;

class EquipementHttpMapper
{

    public static function toDTO(array $data): EquipementInputDTO
    {
        return new EquipementInputDTO(
            nom: $data['nom'],
            description: $data['description'] ?? null
        );
    }

}