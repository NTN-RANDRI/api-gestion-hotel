<?php

namespace App\Application\UseCases\Personnel;

use App\Application\Mappers\PersonnelMapper;
use App\Domain\Repositories\PersonnelRepositoryInterface;

class ListPersonnels
{

    public function __construct(
        private PersonnelRepositoryInterface $personnelRepo,
    )
    {}

    public function execute(): array
    {
        $personnels = $this->personnelRepo->all();

        return PersonnelMapper::toDTOs($personnels);
    }

}