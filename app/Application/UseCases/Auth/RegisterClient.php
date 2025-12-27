<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\Client\ClientInputDTO;
use App\Application\DTOs\Client\ClientOutputDTO;
use App\Application\DTOs\User\UserInputDTO;
use App\Application\Mappers\ClientMapper;
use App\Application\Mappers\UserMapper;
use App\Domain\Entities\Client;
use App\Domain\Repositories\ClientRepositoryInterface;

class RegisterClient
{

    public function __construct(
        private ClientRepositoryInterface $clientRepo,
    )
    {}

    public function execute(ClientInputDTO $clientInput, UserInputDTO $userInput): ClientOutputDTO
    {
        $client = $this->createClientInRepo($clientInput);
        
        $user = $this->clientRepo->createUser($client->getId(), UserMapper::toDomain($userInput));
        
        $client->setUser($user);
        
        return ClientMapper::toDTO($client);
    }

    private function createClientInRepo(ClientInputDTO $clientInput): Client
    {
        $client = ClientMapper::toDomain($clientInput);
        $newClient = $this->clientRepo->save($client);

        return $newClient;
    }

}