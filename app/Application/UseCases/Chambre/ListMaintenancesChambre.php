<?php

namespace App\Application\UseCases\Chambre;

use App\Application\Mappers\MaintenanceMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\MaintenanceRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class ListMaintenancesChambre
{

    public function __construct(
        private MaintenanceRepositoryInterface $maintenanceRepo,
        private ChambreRepositoryInterface $chambreRepo,
    )
    {}

    /** @return \App\Application\DTOs\Maintenance\MaintenanceOutputDTO[] */
    public function execute(int $id): array
    {
        $chambre = $this->chambreRepo->find($id);
        if (!$chambre) throw new EntityNotFoundException('Chambre');

        $maintenances = $this->maintenanceRepo->getByChambreId($id);

        return MaintenanceMapper::toDTOs($maintenances);
    }

}