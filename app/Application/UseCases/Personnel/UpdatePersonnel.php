<?php

namespace App\Application\UseCases\Personnel;

use App\Application\DTOs\Personnel\PersonnelInputDTO;
use App\Application\DTOs\Personnel\PersonnelOutputDTO;
use App\Application\Mappers\PersonnelMapper;
use App\Domain\Repositories\PersonnelRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class UpdatePersonnel
{

    public function __construct(
        private PersonnelRepositoryInterface $personnelRepo,
    )
    {}

    public function execute(int $id, PersonnelInputDTO $personnelInput): PersonnelOutputDTO
    {
        $personnel = $this->personnelRepo->find($id);
        if (!$personnel) throw new EntityNotFoundException('Personnel');

        $personnel->update(
            nom: $personnelInput->nom,
            prenom: $personnelInput->prenom,
            telephone: $personnelInput->telephone,
            role: $personnelInput->role
        );

        $this->personnelRepo->save($personnel);

        return PersonnelMapper::toDTO($personnel);
    }

}