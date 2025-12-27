<?php

namespace App\Application\UseCases\Maintenance;

use App\Application\DTOs\Maintenance\MaintenanceOutputDTO;
use App\Application\Mappers\MaintenanceMapper;
use App\Domain\Repositories\MaintenanceRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class MarkFinMaintenance
{

    public function __construct(
        private MaintenanceRepositoryInterface $maintenanceRepo,
    )
    {}

    public function execute(int $id): MaintenanceOutputDTO
    {
        $maintenance = $this->maintenanceRepo->find($id);
        if (!$maintenance) throw new EntityNotFoundException('Maintenance');

        $maintenance->markFinMaintenance();

        $this->maintenanceRepo->markDateFin($id);

        return MaintenanceMapper::toDTO($maintenance);
    }

}