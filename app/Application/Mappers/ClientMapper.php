<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Client\ClientInputDTO;
use App\Application\DTOs\Client\ClientOutputDTO;
use App\Domain\Entities\Client;

class ClientMapper
{

    public static function toDomain(ClientInputDTO $clientInput): Client
    {
        return new Client(
            id: null,
            nom: $clientInput->nom,
            prenom: $clientInput->prenom,
            telephone: $clientInput->telephone,
            cin: $clientInput->cin
        );
    }

    public static function toDTO(Client $client): ClientOutputDTO
    {
        return new ClientOutputDTO(
            id: $client->getId(),
            nom: $client->getNom(),
            prenom: $client->getPrenom(),
            telephone: $client->getTelephone(),
            cin: $client->getCin()
        );
    }

}