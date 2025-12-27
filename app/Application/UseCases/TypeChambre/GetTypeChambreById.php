<?php

namespace App\Application\UseCases\TypeChambre;

use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;
use App\Application\Mappers\TypeChambreMapper;
use App\Domain\Repositories\TypeChambreRepositoryInterface;

class GetTypeChambreById
{

    public function __construct(
        private TypeChambreRepositoryInterface $typeChambreRepo,
    )
    {}

    public function execute(int $id): TypeChambreOutputDTO
    {
        $typeChambre = $this->typeChambreRepo->find($id);

        return TypeChambreMapper::toDTO($typeChambre);
    }

}