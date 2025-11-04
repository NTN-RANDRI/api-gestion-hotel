<?php

namespace App\Application\UseCases\Client;

use App\Application\DTOs\Client\ClientOutputDTO;
use App\Application\Mappers\ClientMapper;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class GetClientById
{

    public function __construct(
        private ClientRepositoryInterface $clientRepositoryInterface
    )
    {}

    public function execute(int $id): ClientOutputDTO
    {
        $client = $this->clientRepositoryInterface->find($id);

        if (!$client) {
            throw new EntityNotFoundException('Client');
        }

        return ClientMapper::toDTO($client);
    }

}