<?php

namespace App\Application\UseCases\Maintenance;

use App\Application\Mappers\MaintenanceMapper;
use App\Domain\Repositories\MaintenanceRepositoryInterface;

class ListMaintenance
{

    public function __construct(
        private MaintenanceRepositoryInterface $maintenanceRepo,
    )
    {}

    public function execute(): array
    {
        $maintenances = $this->maintenanceRepo->all();

        return MaintenanceMapper::toDTOs($maintenances);
    }

}