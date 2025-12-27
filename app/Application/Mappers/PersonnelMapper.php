<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Personnel\PersonnelInputDTO;
use App\Application\DTOs\Personnel\PersonnelOutputDTO;
use App\Domain\Entities\Personnel;

class PersonnelMapper
{

    public static function toDomain(PersonnelInputDTO $personnelInput): Personnel
    {
        return new Personnel(
            id: null,
            nom: $personnelInput->nom,
            prenom: $personnelInput->prenom,
            telephone: $personnelInput->nom,
            role: $personnelInput->role,
        );
    }

    public static function toDTO(Personnel $personnel): PersonnelOutputDTO
    {
        return new PersonnelOutputDTO(
            id: $personnel->getId(),
            nom: $personnel->getNom(),
            prenom: $personnel->getPrenom(),
            telephone: $personnel->getTelephone(),
            role: $personnel->getRole(),
            user: $personnel->getUser() ? UserMapper::toDTO($personnel->getUser()) : null,
        );
    }

    public static function toDTOs(array $personnels): array
    {
        return array_map(fn($personnel) => self::toDTO($personnel), $personnels);
    }

}