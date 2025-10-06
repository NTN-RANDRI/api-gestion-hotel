<?php

namespace App\Application\UseCases\Equipement;

use App\Application\DTOs\Equipement\EquipementOutputDTO;
use App\Application\Mappers\EquipementRequestMapper;
use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class GetEquipementById
{

    public function __construct(private EquipementRepositoryInterface $equipementRepositoryInterface)
    {}

    public function execute(int $id): EquipementOutputDTO
    {
        $equipement = $this->equipementRepositoryInterface->find($id);

        if (!$equipement) {
            throw new EntityNotFoundException('Equipement');
        }

        return EquipementRequestMapper::toDTO($equipement);
    }

}