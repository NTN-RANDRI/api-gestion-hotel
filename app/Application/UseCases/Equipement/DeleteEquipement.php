<?php

namespace App\Application\UseCases\Equipement;

use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class DeleteEquipement
{

    public function __construct(private EquipementRepositoryInterface $equipementRepositoryInterface)
    {}

    public function execute(int $id): void
    {
        $equipement = $this->equipementRepositoryInterface->find($id);

        if (!$equipement) {
            throw new EntityNotFoundException('Equipement');
        }

        $this->equipementRepositoryInterface->delete($equipement->getId());
    }

}