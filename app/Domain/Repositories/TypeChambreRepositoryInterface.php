<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\TypeChambre;

interface TypeChambreRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?TypeChambre;
    public function save(TypeChambre $equipement): TypeChambre;
    public function delete(int $id): void;
}