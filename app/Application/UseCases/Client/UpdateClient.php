<?php

namespace App\Application\UseCases\Client;

use App\Application\DTOs\Client\ClientInputDTO;
use App\Application\DTOs\Client\ClientOutputDTO;
use App\Application\Mappers\ClientMapper;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class UpdateClient
{

    public function __construct(
        private ClientRepositoryInterface $clientRepositoryInterface
    )
    {}

    public function execute(int $id, ClientInputDTO $clientInput, string $email): ClientOutputDTO
    {
        $client = $this->clientRepositoryInterface->find($id);

        if (!$client) {
            throw new EntityNotFoundException('Client');
        }

        $client->setNom($clientInput->nom);
        $client->setPrenom($clientInput->prenom);
        $client->setTelephone($clientInput->telephone);
        $client->setCin($clientInput->cin);

        $client = $this->clientRepositoryInterface->save($client);

        return ClientMapper::toDTO($client);
    }

}