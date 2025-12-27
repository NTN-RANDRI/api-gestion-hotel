<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Paiement\PaiementInputDTO;
use App\Application\DTOs\Paiement\PaiementOutputDTO;
use App\Domain\Entities\Paiement;
use App\Shared\Utils\DateFormatter;

class PaiementMapper
{

    public static function toDomain(PaiementInputDTO $paiementInput): Paiement
    {
        return new Paiement(
            id: null,
            montant: $paiementInput->montant,
            mode: $paiementInput->mode,
            telephone: $paiementInput->telephone,
        );
    }

    public static function toDTO(Paiement $paiement): PaiementOutputDTO
    {
        return new PaiementOutputDTO(
            id: $paiement->getId(),
            montant: $paiement->getMontant(),
            mode: $paiement->getMode(),
            telephone: $paiement->getTelephone(),
            statut: $paiement->getStatut(),
            datePaiement: DateFormatter::toIso8601($paiement->getDatePaiement()),
        );
    }

    /**
     * @param \App\Domain\Entities\Paiement[] $paiements
     * @return \App\Application\DTOs\Paiement\PaiementOutputDTO[]
     */
    public static function toDTOs(array $paiements): array
    {
        return array_map(function ($paiement) {
            return self::toDTO($paiement);
        }, $paiements);
    }

}