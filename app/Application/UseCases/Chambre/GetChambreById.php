<?php

namespace App\Application\UseCases\Chambre;

use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\Mappers\ChambreRequestMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class GetChambreById
{

    public function __construct(private ChambreRepositoryInterface $chambreRepositoryInterface)
    {}

    public function execute(int $id): ChambreOutputDTO
    {
        $entity = $this->chambreRepositoryInterface->find($id);

        if (!$entity) {
            throw new EntityNotFoundException('Chambre');
        }

        return ChambreRequestMapper::toDTO($entity);
    }

}