<?php 

namespace App\Http\Mappers;

use App\Application\DTOs\Paiement\PaiementInputDTO;

class PaiementHttpMapper
{

    public static function toDTO(array $data): PaiementInputDTO
    {
        return new PaiementInputDTO(
            montant: $data['montant'],
            mode: $data['mode'],
            telephone: $data['telephone'] ?? null,
        );
    }

}