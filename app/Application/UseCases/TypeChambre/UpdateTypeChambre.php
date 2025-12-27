<?php

namespace App\Application\UseCases\TypeChambre;

use App\Application\DTOs\TypeChambre\TypeChambreInputDTO;
use App\Application\DTOs\TypeChambre\TypeChambreOutputDTO;
use App\Application\Mappers\TypeChambreMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class UpdateTypeChambre
{

    public function __construct(
        private TypeChambreRepositoryInterface $typeChambreRepo,
    )
    {}

    public function execute(int $id, TypeChambreInputDTO $inputDTO): TypeChambreOutputDTO
    {
        $type = $this->typeChambreRepo->find($id);
        if (!$type) throw new EntityNotFoundException('Type chambre');

        $type->setNom($inputDTO->nom);
        $type->setNombreLits($inputDTO->nombreLits);
        $type->setCapaciteMax($inputDTO->capaciteMax);
        $type->setDescription($inputDTO->description);
        $type = $this->typeChambreRepo->save($type);

        return TypeChambreMapper::toDTO($type);
    }

}