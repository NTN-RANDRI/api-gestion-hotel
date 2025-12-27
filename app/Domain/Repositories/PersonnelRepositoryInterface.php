<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Personnel;
use App\Domain\Entities\User;

interface PersonnelRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Personnel;
    public function save(Personnel $personnel): Personnel;
    public function delete(int $id): void;
    public function createUser(int $id, User $user): User;
}