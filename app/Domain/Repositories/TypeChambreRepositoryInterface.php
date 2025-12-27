<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\TypeChambre;

interface TypeChambreRepositoryInterface
{   
    /**
     * @return \App\Domain\Entities\TypeChambre[]
     */
    public function all(): array;

    public function find(int $id): ?TypeChambre;

    public function save(TypeChambre $entity): TypeChambre;
    
    public function delete(int $id): void;
}