<?php

namespace App\Application\UseCases\Auth;

use App\Application\DTOs\Personnel\PersonnelInputDTO;
use App\Application\DTOs\Personnel\PersonnelOutputDTO;
use App\Application\DTOs\User\UserInputDTO;
use App\Application\Mappers\PersonnelMapper;
use App\Application\Mappers\UserMapper;
use App\Domain\Entities\Personnel;
use App\Domain\Repositories\PersonnelRepositoryInterface;

class RegisterPersonnel
{

    public function __construct(
        private PersonnelRepositoryInterface $personnelRepo,
    )
    {}

    public function execute(PersonnelInputDTO $personnelInput, UserInputDTO $userInput): PersonnelOutputDTO
    {
        $personnel = $this->createPersonnelInRepo($personnelInput);
        
        $user = $this->personnelRepo->createUser($personnel->getId(), UserMapper::toDomain($userInput));
        
        $personnel->setUser($user);
        
        return PersonnelMapper::toDTO($personnel);
    }

    private function createPersonnelInRepo(PersonnelInputDTO $personnelInput): Personnel
    {
        $personnel = PersonnelMapper::toDomain($personnelInput);
        $newPersonnel = $this->personnelRepo->save($personnel);

        return $newPersonnel;
    }

}