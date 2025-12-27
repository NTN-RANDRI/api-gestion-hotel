<?php

namespace App\Application\DTOs\Maintenance;

use App\Application\DTOs\Chambre\ChambreOutputDTO;

class MaintenanceOutputDTO
{

    public function __construct(
        public int $id,
        public string $dateDebut,
        public string $description,
        public ChambreOutputDTO $chambre,
        public string $statut,
        public ?string $dateFin,
        public ?string $datePrevus,
    )
    {}

}