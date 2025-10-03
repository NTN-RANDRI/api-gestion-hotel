<?php

namespace App\Application\UseCases\Equipement;

use App\Application\DTOs\Equipement\EquipementOutputDTO;
use App\Domain\Repositories\EquipementRepositoryInterface;

class GetEquipementById
{

    public function __construct(private EquipementRepositoryInterface $equipementRepositoryInterface)
    {}

    public function execute(int $id): EquipementOutputDTO
    {
        $equipement = $this->equipementRepositoryInterface->find($id);

        if (!$equipement) {
            throw new \Exception("Equipement not found");
        }

        return new EquipementOutputDTO(
            $equipement->getId(),
            $equipement->getNom(),
            $equipement->getDescription()
        );
    }

}