<?php

namespace App\Application\UseCases\Personnel;

use App\Application\DTOs\Personnel\PersonnelInputDTO;
use App\Application\DTOs\Personnel\PersonnelOutputDTO;
use App\Application\Mappers\PersonnelMapper;
use App\Domain\Repositories\PersonnelRepositoryInterface;

class CreatePersonnel
{

    public function __construct(
        private PersonnelRepositoryInterface $personnelRepo,
    )
    {}

    public function execute(PersonnelInputDTO $personnelInput): PersonnelOutputDTO
    {
        $personnel = PersonnelMapper::toDomain($personnelInput);
        $newPersonnel = $this->personnelRepo->save($personnel);

        return PersonnelMapper::toDTO($newPersonnel);
    }

}