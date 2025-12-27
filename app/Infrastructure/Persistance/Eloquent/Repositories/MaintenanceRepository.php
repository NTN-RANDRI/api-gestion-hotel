<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\Maintenance;
use App\Domain\Repositories\MaintenanceRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\MaintenanceModelMapper;
use App\Models\Maintenance as MaintenanceModel;

class MaintenanceRepository implements MaintenanceRepositoryInterface
{

    public function all(): array
    {
        $models = MaintenanceModel::all();
        
        return MaintenanceModelMapper::toDomains($models);
    }

    public function find(int $id): ?Maintenance
    {
        $model = MaintenanceModel::find($id);
        if (!$model) return null;

        return MaintenanceModelMapper::toDomain($model);
    }

    public function save(Maintenance $maintenance): Maintenance
    {
        $id = $maintenance->getId();

        if ($id) {
            $model = MaintenanceModel::find($id);
            $model->update(MaintenanceModelMapper::toArray($maintenance));
        } else {
            $model = MaintenanceModel::create(MaintenanceModelMapper::toArray($maintenance))->fresh();
        }

        return MaintenanceModelMapper::toDomain($model);
    }

    public function delete(int $id): void
    {
        $model = MaintenanceModel::find($id);
        $model->delete();
    }

    public function markDateFin(int $id): void
    {
        $model = MaintenanceModel::find($id);
        $model->date_fin = now()->toDateTimeString();
        $model->save();
    }

    public function getByChambreId(int $chambreId): array
    {
        $models = MaintenanceModel::where('chambre_id', $chambreId)->get();

        return MaintenanceModelMapper::toDomains($models);
    }

}