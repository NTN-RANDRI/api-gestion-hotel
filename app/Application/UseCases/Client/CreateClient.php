<?php

namespace App\Application\UseCases\Client;

use App\Application\DTOs\Client\ClientInputDTO;
use App\Application\DTOs\Client\ClientOutputDTO;
use App\Application\Mappers\ClientMapper;
use App\Domain\Repositories\ClientRepositoryInterface;

class CreateClient
{

    public function __construct(
        private ClientRepositoryInterface $clientRepositoryInterface
    )
    {}

    public function execute(ClientInputDTO $clientInput): ClientOutputDTO
    {
        $client = ClientMapper::toDomain($clientInput);
        $client = $this->clientRepositoryInterface->save($client);

        return ClientMapper::toDTO($client);
    }

}