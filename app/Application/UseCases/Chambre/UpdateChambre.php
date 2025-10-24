<?php

namespace App\Application\UseCases\Chambre;

use App\Application\DTOs\Chambre\ChambreInputDTO;
use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\Mappers\ChambreMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class UpdateChambre
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepositoryInterface,
        private TypeChambreRepositoryInterface $typeChambreRepositoryInterface,
        private EquipementRepositoryInterface $equipementRepositoryInterface
    )
    {}

    public function execute(int $id, ChambreInputDTO $inputDTO): ChambreOutputDTO
    {
        $entity = $this->chambreRepositoryInterface->find($id);
        if (!$entity) { throw new EntityNotFoundException('Chambre'); }

        $typeChambreEntity = $this->typeChambreRepositoryInterface->find($inputDTO->typeChambreId);
        if (!$typeChambreEntity) { throw new EntityNotFoundException('TypeChambre'); }

        $equipementsEntity = array_map(
            fn ($equipementId) => $this->equipementRepositoryInterface->find($equipementId),
            $inputDTO->equipementIds
        );

        foreach ($equipementsEntity as $equipement) {
            if (!$equipement) {
                throw new EntityNotFoundException('Equipement');
            }
        }

        $entity->setNumero($inputDTO->numero);
        $entity->setPrixNuit($inputDTO->prixNuit);
        $entity->setDescription($inputDTO->description);
        $entity->setTypeChambre($typeChambreEntity);
        $entity->setEquipements($equipementsEntity);

        $entity = $this->chambreRepositoryInterface->save($entity);

        return ChambreMapper::toDTO($entity);

    }

}