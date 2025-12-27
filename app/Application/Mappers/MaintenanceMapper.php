<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Maintenance\MaintenanceInputDTO;
use App\Application\DTOs\Maintenance\MaintenanceOutputDTO;
use App\Domain\Entities\Chambre;
use App\Domain\Entities\Maintenance;

class MaintenanceMapper
{

    public static function toDomain(MaintenanceInputDTO $maintenanceInput, Chambre $chambre): Maintenance
    {
        return new Maintenance(
            id: null,
            dateDebut: $maintenanceInput->dateDebut,
            description: $maintenanceInput->description,
            chambre: $chambre,
            datePrevus: $maintenanceInput->datePrevus,
        );
    }

    public static function toDTO(Maintenance $maintenance): MaintenanceOutputDTO
    {
        $chambreOutput = ChambreMapper::toDTO($maintenance->getChambre());

        return new MaintenanceOutputDTO(
            id: $maintenance->getId(),
            dateDebut: $maintenance->getDateDebut(),
            description: $maintenance->getDescription(),
            chambre: $chambreOutput,
            statut: $maintenance->getStatut(),
            dateFin: $maintenance->getDateFin(),
            datePrevus: $maintenance->getDatePrevus(),
        );
    }

    /**
     * @param \App\Domain\Entities\Maintenance[] $maintenances
     * @return \App\Application\DTOs\Maintenance\MaintenanceOutputDTO[]
     */
    public static function toDTOs(array $maintenances): array 
    {
        $maintenanceOutputs = array_map(fn($maintenance) => self::toDTO($maintenance), $maintenances);

        return $maintenanceOutputs;
    }

}