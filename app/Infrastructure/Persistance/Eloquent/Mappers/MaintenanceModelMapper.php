<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Maintenance;
use App\Models\Maintenance as MaintenanceModel;
use Illuminate\Database\Eloquent\Collection;

class MaintenanceModelMapper
{

    public static function toArray(Maintenance $maintenance): array
    {
        return [
            'date_debut' => $maintenance->getDateDebut(),
            'date_prevus' => $maintenance->getDatePrevus(),
            'description' => $maintenance->getDescription(),
            'chambre_id' => $maintenance->getChambre()->getId(),
        ];
    }

    public static function toDomain(MaintenanceModel $model): Maintenance
    {
        $chambre = ChambreModelMapper::toDomain($model->chambre);

        return new Maintenance(
            id: $model->id,
            dateDebut: $model->date_debut,
            description: $model->description,
            chambre: $chambre,
            dateFin: $model->date_fin,
            datePrevus: $model->date_prevus,
            statut: $model->statut,
        );
    }

    /**
     * @return \App\Domain\Entities\Maintenance[]
     */
    public static function toDomains(Collection $models): array
    {
        $maintenances = $models->map(fn ($model) => self::toDomain($model))->all();

        return $maintenances;
    }

}