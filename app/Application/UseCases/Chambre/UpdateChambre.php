<?php

namespace App\Application\UseCases\Chambre;

use App\Application\DTOs\Chambre\ChambreInputDTO;
use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\Mappers\ChambreMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class UpdateChambre
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepositoryInterface,
        private TypeChambreRepositoryInterface $typeChambreRepositoryInterface
    )
    {}

    public function execute(int $id, ChambreInputDTO $inputDTO): ChambreOutputDTO
    {
        $entity = $this->chambreRepositoryInterface->find($id);
        if (!$entity) { throw new EntityNotFoundException('Chambre'); }

        $typeChambreEntity = $this->typeChambreRepositoryInterface->find($inputDTO->typeChambreId);
        if (!$typeChambreEntity) { throw new EntityNotFoundException('TypeChambre'); }

        $entity->setNumero($inputDTO->numero);
        $entity->setPrixNuit($inputDTO->prixNuit);
        $entity->setDescription($inputDTO->description);
        $entity->setTypeChambre($typeChambreEntity);

        $entity = $this->chambreRepositoryInterface->save($entity);

        return ChambreMapper::toDTO($entity);

    }

}