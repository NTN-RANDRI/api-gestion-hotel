<?php

namespace App\Application\UseCases\TypeChambre;

use App\Application\Mappers\TypeChambreMapper;
use App\Domain\Repositories\TypeChambreRepositoryInterface;

class ListTypeChambre
{

    public function __construct(
        private TypeChambreRepositoryInterface $typeChambreRepo,
    )
    {}

    public function execute(): array
    {
        $typeChambres = $this->typeChambreRepo->all();

        return TypeChambreMapper::toDTOs($typeChambres);
    }

}