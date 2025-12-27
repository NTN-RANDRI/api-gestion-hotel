<?php

namespace App\Application\UseCases\Personnel;

use App\Application\DTOs\Personnel\PersonnelOutputDTO;
use App\Application\Mappers\PersonnelMapper;
use App\Domain\Repositories\PersonnelRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class GetPersonnelById
{

    public function __construct(
        private PersonnelRepositoryInterface $personnelRepo,
    )
    {}

    public function execute(int $id): PersonnelOutputDTO
    {
        $personnel = $this->personnelRepo->find($id);
        if (!$personnel) throw new EntityNotFoundException('Personnel');

        return PersonnelMapper::toDTO($personnel);
    }

}