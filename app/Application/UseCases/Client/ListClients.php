<?php

namespace App\Application\UseCases\Client;

use App\Application\Mappers\ClientMapper;
use App\Domain\Repositories\ClientRepositoryInterface;

class ListClients
{

    public function __construct(
        private ClientRepositoryInterface $clientRepositoryInterface
    )
    {}

    public function execute(): array
    {
        $clients = $this->clientRepositoryInterface->all();

        return array_map(fn($client) => ClientMapper::toDTO($client), $clients);
    }

}