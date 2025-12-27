<?php

namespace App\Application\DTOs\Maintenance;

class UpdateMaintenanceInputDTO 
{

    public function __construct(
        public string $dateDebut,
        public string $description,
        public ?string $datePrevus
    )
    {}

}