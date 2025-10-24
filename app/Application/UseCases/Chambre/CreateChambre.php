<?php

namespace App\Application\UseCases\Chambre;

use App\Application\DTOs\Chambre\ChambreInputDTO;
use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\Mappers\ChambreMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class CreateChambre
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepositoryInterface,
        private TypeChambreRepositoryInterface $typeChambreRepositoryInterface,
        private EquipementRepositoryInterface $equipementRepositoryInterface
    )
    {}

    public function execute(ChambreInputDTO $inputDTO): ChambreOutputDTO
    {
        $typeChambreEntity = $this->typeChambreRepositoryInterface->find($inputDTO->typeChambreId);

        if (!$typeChambreEntity) {
            throw new EntityNotFoundException('TypeChambre');
        }

        $equipementsEntity = array_map(
            fn ($equipementId) => $this->equipementRepositoryInterface->find($equipementId),
            $inputDTO->equipementIds
        );

        foreach ($equipementsEntity as $equipement) {
            if (!$equipement) {
                throw new EntityNotFoundException('Equipement');
            }
        }

        $entity = ChambreMapper::toDomain($inputDTO, $typeChambreEntity, $equipementsEntity);

        $entity = $this->chambreRepositoryInterface->save($entity);

        return ChambreMapper::toDTO($entity);
    }

}