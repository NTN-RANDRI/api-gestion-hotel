<?php

namespace App\Application\DTOs\Maintenance;

class MaintenanceInputDTO 
{

    public function __construct(
        public string $dateDebut,
        public string $description,
        public int $chambreId,
        public ?string $datePrevus
    )
    {}

}