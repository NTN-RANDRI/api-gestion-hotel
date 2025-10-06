<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Chambre;

interface ChambreRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Chambre;
    public function save(Chambre $entity): Chambre;
    public function delete(int $id): void;
}