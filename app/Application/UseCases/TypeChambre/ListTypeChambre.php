<?php

namespace App\Application\UseCases\TypeChambre;

use App\Application\Mappers\TypeChambreMapper;
use App\Domain\Repositories\TypeChambreRepositoryInterface;

class ListTypeChambre
{

    public function __construct(private TypeChambreRepositoryInterface $typeChambreRepositoryInterface)
    {}

    public function execute(): array
    {
        $entityCollection = $this->typeChambreRepositoryInterface->all();

        return array_map(fn($entity) => TypeChambreMapper::toDTO($entity), $entityCollection);
    }

}