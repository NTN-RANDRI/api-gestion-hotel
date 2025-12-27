<?php

namespace App\Application\UseCases\Maintenance;

use App\Application\DTOs\Maintenance\MaintenanceInputDTO;
use App\Application\DTOs\Maintenance\MaintenanceOutputDTO;
use App\Application\Mappers\MaintenanceMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\MaintenanceRepositoryInterface;

class CreateMaintenance
{

    public function __construct(
        private MaintenanceRepositoryInterface $maintenanceRepo,
        private ChambreRepositoryInterface $chambreRepo,
    )
    {}

    public function execute(MaintenanceInputDTO $maintenanceInput): MaintenanceOutputDTO
    {
        $chambre = $this->chambreRepo->find($maintenanceInput->chambreId);
        $maintenance = MaintenanceMapper::toDomain($maintenanceInput, $chambre);

        $newMaintenance = $this->maintenanceRepo->save($maintenance);

        return MaintenanceMapper::toDTO($newMaintenance);
    }
}