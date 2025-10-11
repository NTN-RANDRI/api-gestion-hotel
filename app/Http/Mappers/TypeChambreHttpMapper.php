<?php

namespace App\Http\Mappers;

use App\Application\DTOs\TypeChambre\TypeChambreInputDTO;

class TypeChambreHttpMapper
{

    public static function toDTO(array $data): TypeChambreInputDTO
    {
        return new TypeChambreInputDTO(
            nom: $data['nom'],
            nombreLits: $data['nombre_lits'],
            capaciteMax: $data['capacite_max'],
            description: $data['description'] ?? null
        );
    }

}