<?php

namespace App\Application\UseCases\Equipement;

use App\Application\DTOs\Equipement\EquipementInputDTO;
use App\Application\DTOs\Equipement\EquipementOutputDTO;
use App\Domain\Entities\Equipement;
use App\Domain\Repositories\EquipementRepositoryInterface;

class CreateEquipement
{

    public function __construct(private EquipementRepositoryInterface $equipementRepositoryInterface)
    {}

    public function execute(EquipementInputDTO $equipementInputDTO): EquipementOutputDTO
    {
        $equipement = $equipementInputDTO->toEquipement();

        $equipement = $this->equipementRepositoryInterface->save($equipement);

        return new EquipementOutputDTO(
            $equipement->getId(),
            $equipement->getNom(),
            $equipement->getDescription()
        );
    }

}