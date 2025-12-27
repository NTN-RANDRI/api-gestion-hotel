<?php 

namespace App\Http\Mappers;

use App\Application\DTOs\Maintenance\MaintenanceInputDTO;
use App\Application\DTOs\Maintenance\UpdateMaintenanceInputDTO;

class MaintenanceHttpMapper
{

    public static function toDTO(array $data): MaintenanceInputDTO
    {
        return new MaintenanceInputDTO(
            dateDebut: $data['date_debut'],
            description: $data['description'],
            chambreId: $data['chambre_id'],
            datePrevus: $data['date_prevus'] ?? null,
        );
    }

    public static function toUpdateDTO(array $data): UpdateMaintenanceInputDTO
    {
        return new UpdateMaintenanceInputDTO(
            dateDebut: $data['date_debut'],
            description: $data['description'],
            datePrevus: $data['date_prevus'] ?? null,
        );
    }

}