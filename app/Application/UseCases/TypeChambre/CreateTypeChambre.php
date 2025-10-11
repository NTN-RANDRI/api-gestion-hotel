<?php

namespace App\Application\UseCases\TypeChambre;

use App\Application\DTOs\TypeChambre\TypeChambreInputDTO;
use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;
use App\Application\Mappers\TypeChambreMapper;
use App\Domain\Repositories\TypeChambreRepositoryInterface;

class CreateTypeChambre
{

    public function __construct(private TypeChambreRepositoryInterface $typeChambreRepositoryInterface)
    {}

    public function execute(TypeChambreInputDTO $inputDTO): TypeChambreOutputDTO
    {
        $entity = TypeChambreMapper::toDomain($inputDTO);
        $entity = $this->typeChambreRepositoryInterface->save($entity);

        return TypeChambreMapper::toDTO($entity);
    }

}