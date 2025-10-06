<?php

namespace App\Application\UseCases\Equipement;

use App\Application\Mappers\EquipementRequestMapper;
use App\Domain\Repositories\EquipementRepositoryInterface;

class ListEquipements
{

    public function __construct(private EquipementRepositoryInterface $equipementRepositoryInterface)
    {}

    public function execute(): array
    {
        $equipements = $this->equipementRepositoryInterface->all();

        return array_map(fn($equipement) => EquipementRequestMapper::toDTO($equipement), $equipements);
    }

}