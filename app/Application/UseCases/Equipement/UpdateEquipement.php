<?php

namespace App\Application\UseCases\Equipement;

use App\Application\DTOs\Equipement\EquipementInputDTO;
use App\Application\DTOs\Equipement\EquipementOutputDTO;
use App\Application\Mappers\EquipementMapper;
use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class UpdateEquipement
{

    public function __construct(private EquipementRepositoryInterface $equipementRepositoryInterface)
    {}

    public function execute(int $id, EquipementInputDTO $equipementInputDTO): EquipementOutputDTO
    {
        $equipement = $this->equipementRepositoryInterface->find($id);

        if (!$equipement) {
            throw new EntityNotFoundException('Equipement');
        }

        $equipement->setNom($equipementInputDTO->nom);
        $equipement->setDescription($equipementInputDTO->description);

        $this->equipementRepositoryInterface->save($equipement);

        return EquipementMapper::toDTO($equipement);
    }

}