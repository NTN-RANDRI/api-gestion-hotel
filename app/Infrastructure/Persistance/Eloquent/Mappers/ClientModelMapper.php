<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Client;
use App\Models\Client as ClientModel;

class ClientModelMapper
{

    public static function toArray(Client $client): array
    {
        return [
            'nom' => $client->getNom(),
            'prenom' => $client->getPrenom(),
            'telephone' => $client->getTelephone(),
            'cin' => $client->getCin(),
        ];
    }

    public static function toDomain(ClientModel $clientModel): Client
    {
        return new Client(
            id: $clientModel->id,
            nom: $clientModel->nom,
            prenom: $clientModel->prenom,
            telephone: $clientModel->telephone,
            cin: $clientModel->cin
        );
    }

}