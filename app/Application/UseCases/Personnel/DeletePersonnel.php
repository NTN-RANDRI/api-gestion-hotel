<?php

namespace App\Application\UseCases\Personnel;

use App\Domain\Repositories\PersonnelRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class DeletePersonnel
{

    public function __construct(
        private PersonnelRepositoryInterface $personnelRepo,
    )
    {}

    public function execute(int $id): void
    {
        $personnel = $this->personnelRepo->find($id);
        if (!$personnel) throw new EntityNotFoundException('Personnel');

        $this->personnelRepo->delete($id);
    }

}