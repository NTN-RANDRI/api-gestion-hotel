<?php

namespace App\Application\UseCases\Maintenance;

use App\Domain\Repositories\MaintenanceRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class DeleteMaintenance
{

    public function __construct(
        private MaintenanceRepositoryInterface $maintenanceRepo,
    )
    {}

    public function execute(int $id): void
    {
        $maintenance = $this->maintenanceRepo->find($id);
        if (!$maintenance) throw new EntityNotFoundException('Maintenance');

        $this->maintenanceRepo->delete($id);
    }

}