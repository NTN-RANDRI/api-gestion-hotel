<?php

namespace App\Application\UseCases\Maintenance;

use App\Application\DTOs\Maintenance\MaintenanceOutputDTO;
use App\Application\DTOs\Maintenance\UpdateMaintenanceInputDTO;
use App\Application\Mappers\MaintenanceMapper;
use App\Domain\Repositories\MaintenanceRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class UpdateMaintenance
{

    public function __construct(
        private MaintenanceRepositoryInterface $maintenanceRepo,
    )
    {}

    public function execute(int $id, UpdateMaintenanceInputDTO $maintenanceInput): MaintenanceOutputDTO
    { 
        $maintenance = $this->maintenanceRepo->find($id);
        if (!$maintenance) throw new EntityNotFoundException('Maintenance');

        $maintenance->setDateDebut($maintenanceInput->dateDebut);
        $maintenance->setDescription($maintenanceInput->description);
        $maintenance->setDatePrevus($maintenance->getDatePrevus());

        $this->maintenanceRepo->save($maintenance);

        return MaintenanceMapper::toDTO($maintenance);
    }

}