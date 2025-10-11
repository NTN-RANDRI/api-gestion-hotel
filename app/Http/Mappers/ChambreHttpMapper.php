<?php

namespace App\Http\Mappers;

use App\Application\DTOs\Chambre\ChambreInputDTO;

class ChambreHttpMapper
{

    public static function toDTO(array $data): ChambreInputDTO
    {
        return new ChambreInputDTO(
            numero: $data['numero'],
            prixNuit: $data['prix_nuit'],
            description: $data['description'] ?? null,
            typeChambreId: $data['type_chambre_id']
        );
    }

}