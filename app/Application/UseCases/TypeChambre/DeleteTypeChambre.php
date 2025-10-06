<?php

namespace App\Application\UseCases\TypeChambre;

use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class DeleteTypeChambre
{

    public function __construct(private TypeChambreRepositoryInterface $typeChambreRepositoryInterface)
    {}

    public function execute(int $id): void
    {
        $entity = $this->typeChambreRepositoryInterface->find($id);

        if (!$entity) {
            throw new EntityNotFoundException('TypeChambre');
        }

        $this->typeChambreRepositoryInterface->delete($entity->getId());
    }

}