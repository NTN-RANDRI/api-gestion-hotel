<?php

namespace App\Application\UseCases\Equipement;

use App\Application\DTOs\Equipement\EquipementOutputDTO;
use App\Domain\Repositories\EquipementRepositoryInterface;

class ListEquipements
{

    public function __construct(private EquipementRepositoryInterface $equipementRepositoryInterface)
    {}

    public function execute(): array
    {
        $equipements = $this->equipementRepositoryInterface->all();

        return array_map(fn($equipement) => new EquipementOutputDTO(
            id: $equipement->getId(),
            nom: $equipement->getNom(),
            description: $equipement->getDescription()
        ), $equipements);
    }

}