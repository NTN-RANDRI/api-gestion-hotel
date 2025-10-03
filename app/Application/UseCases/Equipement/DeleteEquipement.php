<?php

namespace App\Application\UseCases\Equipement;

use App\Domain\Repositories\EquipementRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DeleteEquipement
{

    public function __construct(private EquipementRepositoryInterface $equipementRepositoryInterface)
    {}

    public function execute(int $id): void
    {
        $equipement = $this->equipementRepositoryInterface->find($id);

        if (!$equipement) {
            throw new NotFoundHttpException("Equipement not found");
        }

        $this->equipementRepositoryInterface->delete($equipement->getId());
    }

}