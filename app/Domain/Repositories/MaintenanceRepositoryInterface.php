<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Maintenance;

interface MaintenanceRepositoryInterface
{
    /** @return \App\Domain\Entities\Maintenance[] */
    public function all(): array;

    public function find(int $id): ?Maintenance;

    public function save(Maintenance $maintenance): Maintenance;

    public function delete(int $id): void;

    public function markDateFin(int $id): void;

    /** @return \App\Domain\Entities\Maintenance[] */
    public function getByChambreId(int $chambreId): array;
}