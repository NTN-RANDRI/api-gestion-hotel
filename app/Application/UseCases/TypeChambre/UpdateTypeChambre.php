<?php

namespace App\Application\UseCases\TypeChambre;

use App\Application\DTOs\TypeChambre\TypeChambreInputDTO;
use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;
use App\Application\Mappers\TypeChambreMapper;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class UpdateTypeChambre
{

    public function __construct(private TypeChambreRepositoryInterface $typeChambreRepositoryInterface)
    {}

    public function execute(int $id, TypeChambreInputDTO $inputDTO): TypeChambreOutputDTO
    {
        $entity = $this->typeChambreRepositoryInterface->find($id);

        if (!$entity) {
            throw new EntityNotFoundException('TypeChambre');
        }

        $entity->setNom($inputDTO->nom);
        $entity->setNombreLits($inputDTO->nombreLits);
        $entity->setCapaciteMax($inputDTO->capaciteMax);
        $entity->setDescription($inputDTO->description);

        $entity = $this->typeChambreRepositoryInterface->save($entity);

        return TypeChambreMapper::toDTO($entity);
    }

}