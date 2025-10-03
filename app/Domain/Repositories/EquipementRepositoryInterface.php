<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Equipement;

interface EquipementRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Equipement;
    public function save(Equipement $equipement): Equipement;
    public function delete(int $id): void;
}