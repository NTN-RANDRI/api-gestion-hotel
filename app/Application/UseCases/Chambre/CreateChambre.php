<?php

namespace App\Application\UseCases\Chambre;

use App\Application\DTOs\Chambre\ChambreInputDTO;
use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\Mappers\ChambreRequestMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class CreateChambre
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepositoryInterface,
        private TypeChambreRepositoryInterface $typeChambreRepositoryInterface
    )
    {}

    public function execute(ChambreInputDTO $inputDTO): ChambreOutputDTO
    {
        $typeChambreEntity = $this->typeChambreRepositoryInterface->find($inputDTO->typeChambreId);

        if (!$typeChambreEntity) {
            throw new EntityNotFoundException('TypeChambre');
        }

        $entity = ChambreRequestMapper::toDomain($inputDTO, $typeChambreEntity);
        $entity = $this->chambreRepositoryInterface->save($entity);

        return ChambreRequestMapper::toDTO($entity);
    }

}