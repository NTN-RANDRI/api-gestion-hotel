<?php

namespace App\Application\UseCases\TypeChambre;

use App\Application\DTOs\TypeChambre\TypeChambreInputDTO;
use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;
use App\Application\Mappers\TypeChambreMapper;
use App\Domain\Repositories\TypeChambreRepositoryInterface;

class CreateTypeChambre
{

    public function __construct(
        private TypeChambreRepositoryInterface $typeChambreRepo,
    )
    {}

    public function execute(TypeChambreInputDTO $inputDTO): TypeChambreOutputDTO
    {
        $type = TypeChambreMapper::toDomain($inputDTO);
        $type = $this->typeChambreRepo->save($type);

        return TypeChambreMapper::toDTO($type);
    }

}