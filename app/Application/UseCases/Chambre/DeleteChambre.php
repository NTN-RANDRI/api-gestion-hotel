<?php

namespace App\Application\UseCases\Chambre;

use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class DeleteChambre
{

    public function __construct(private ChambreRepositoryInterface $chambreRepositoryInterface)
    {}

    public function execute(int $id): void
    {
        $entity = $this->chambreRepositoryInterface->find($id);

        if (!$entity) {
            throw new EntityNotFoundException('Chambre'); 
        }

        $this->chambreRepositoryInterface->delete($entity->getId());
    }

}