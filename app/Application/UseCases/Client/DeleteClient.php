<?php

namespace App\Application\UseCases\Client;

use App\Domain\Repositories\ClientRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class DeleteClient
{

    public function __construct(
        private ClientRepositoryInterface $clientRepositoryInterface
    )
    {}

    public function execute(int $id): void
    {
        $client = $this->clientRepositoryInterface->find($id);

        if (!$client) {
            throw new EntityNotFoundException('Client');
        }

        $this->clientRepositoryInterface->delete($client->getId());
    }

}