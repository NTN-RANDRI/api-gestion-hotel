<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Client;
use App\Domain\Entities\User;

interface ClientRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Client;
    public function save(Client $client): Client;
    public function delete(int $id): void;
    public function createUser(int $id, User $user): User;
}