<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\Client\ClientOutputDTO;
use App\Application\DTOs\Personnel\PersonnelOutputDTO;
use App\Application\Mappers\ClientMapper;
use App\Application\Mappers\PersonnelMapper;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Domain\Repositories\PersonnelRepositoryInterface;
use Exception;

class GetAuthByUserable
{

    public function __construct(
        private ClientRepositoryInterface $clientRepo,
        private PersonnelRepositoryInterface $personnelRepo,
    )
    {}

    public function execute(int $userable_id, string $userable_type): ClientOutputDTO|PersonnelOutputDTO
    {
        if ($userable_type === 'Client') {
            $client = $this->clientRepo->find($userable_id);

            return ClientMapper::toDTO($client);
        }

        if ($userable_type === 'Personnel') {
            $personnel = $this->personnelRepo->find($userable_id);

            return PersonnelMapper::toDTO($personnel);
        }

        throw new Exception('Get Auth error');
    }
}