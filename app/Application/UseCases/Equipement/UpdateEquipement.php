<?php

namespace App\Application\UseCases\Equipement;

use App\Application\DTOs\Equipement\EquipementInputDTO;
use App\Application\DTOs\Equipement\EquipementOutputDTO;
use App\Domain\Repositories\EquipementRepositoryInterface;

class UpdateEquipement
{

    public function __construct(private EquipementRepositoryInterface $equipementRepositoryInterface)
    {}

    public function execute(int $id, EquipementInputDTO $equipementInputDTO): EquipementOutputDTO
    {
        $equipement = $this->equipementRepositoryInterface->find($id);

        if (!$equipement) {
            throw new \Exception("Equipement not found");
        }

        $equipement->setNom($equipementInputDTO->nom);
        $equipement->setDescription($equipementInputDTO->description);

        $this->equipementRepositoryInterface->save($equipement);

        return new EquipementOutputDTO(
            $equipement->getId(),
            $equipement->getNom(),
            $equipement->getDescription()
        );
    }

}