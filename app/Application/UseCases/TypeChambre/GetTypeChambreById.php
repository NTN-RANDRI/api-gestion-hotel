<?php

namespace App\Application\UseCases\TypeChambre;

use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;
use App\Application\Mappers\TypeChambreRequestMapper;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class GetTypeChambreById
{

    public function __construct(private TypeChambreRepositoryInterface $typeChambreRepositoryInterface)
    {}

    public function execute(int $id): TypeChambreOutputDTO
    {
        $entity = $this->typeChambreRepositoryInterface->find($id);

        if (!$entity) {
            throw new EntityNotFoundException('TypeChambre');
        }

        return TypeChambreRequestMapper::toDTO($entity);
    }

}