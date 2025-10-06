<?php

namespace App\Application\UseCases\Equipement;

use App\Application\DTOs\Equipement\EquipementInputDTO;
use App\Application\DTOs\Equipement\EquipementOutputDTO;
use App\Application\Mappers\EquipementRequestMapper;
use App\Domain\Repositories\EquipementRepositoryInterface;

class CreateEquipement
{

    public function __construct(private EquipementRepositoryInterface $equipementRepositoryInterface)
    {}

    public function execute(EquipementInputDTO $equipementInputDTO): EquipementOutputDTO
    {
        $equipement = EquipementRequestMapper::toDomain($equipementInputDTO);
        $equipement = $this->equipementRepositoryInterface->save($equipement);

        return EquipementRequestMapper::toDTO($equipement);
    }

}