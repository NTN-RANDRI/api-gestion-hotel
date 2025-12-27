<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\Chambre;
use App\Domain\Entities\Equipement;
use App\Domain\Entities\Image;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\ChambreModelMapper;
use App\Infrastructure\Persistance\Eloquent\Mappers\ImageModelMapper;
use App\Models\Chambre as ChambreModel;
use DateTime;
use Illuminate\Database\Eloquent\Builder;

class ChambreRepository implements ChambreRepositoryInterface
{

    public function all(): array
    {
        $models = ChambreModel::all();
        $chambres = $models->map(fn($model) => ChambreModelMapper::toDomain($model))->all();

        return $chambres;
    }

    public function find(int $id): ?Chambre
    {
        $model = ChambreModel::find($id);
        if (!$model) return null;

        $chambre = ChambreModelMapper::toDomain($model);

        return $chambre;
    }

    public function findByTypeChambreId(int $typeChambreId): array
    {
        $models = ChambreModel::where('type_chambre_id', $typeChambreId)->get();
        $chambres = $models->map(fn($model) => ChambreModelMapper::toDomain($model))->all();

        return $chambres;
    }

    public function save(Chambre $entity): Chambre
    {
        $id = $entity->getId();

        if ($id) {
            $model = ChambreModel::find($id);
            $model->update(ChambreModelMapper::toArray($entity));
            $chambre = ChambreModelMapper::toDomain($model);

            return $chambre;
        } else {
            $model = ChambreModel::create(ChambreModelMapper::toArray($entity))->fresh();

            return ChambreModelMapper::toDomain($model);
        }
    }

    public function delete(int $id): void
    {
        $model = ChambreModel::find($id);
        $model->delete();
    }

    public function attachEquipement(Chambre $chambre, Equipement $equipement): void
    {
        $chambreModel = ChambreModel::find($chambre->getId());
        $chambreModel->equipements()->attach($equipement->getId());
    }

    public function syncEquipements(Chambre $chambre, array $equipements): void
    {
        $chambreModel = ChambreModel::find($chambre->getId());
        $equipementIds = array_map(fn ($equipement) => $equipement->getId(), $equipements);
        $chambreModel->equipements()->sync($equipementIds);
    }

    public function createImage(Chambre $chambre, string $filePath): Image
    {
        $chambreModel = ChambreModel::find($chambre->getId());
        $imageModel = $chambreModel->images()->create(['path' => $filePath]);

        return ImageModelMapper::toDomain($imageModel);
    }

    public function disponible(DateTime $dateDebut, DateTime $dateFin, ?int $reservationIdToIgnore = null): array
    {
        $models = ChambreModel::whereDoesntHave('reservations', function (Builder $query) use ($dateDebut, $dateFin, $reservationIdToIgnore) {
            if ($reservationIdToIgnore) {
                $query->where('reservations.id', '!=', $reservationIdToIgnore);
            }

            $query->where(function ($q) use ($dateDebut, $dateFin) {
                $q->whereDate('date_debut', '<=', $dateFin)
                ->whereDate('date_fin', '>', $dateDebut);
            });
        })->get();

        $entityArray = $models->map(fn ($model) => ChambreModelMapper::toDomain($model))->all();

        return $entityArray;
    }

    public function occupee(DateTime $dateDebut, DateTime $dateFin): array
    {
        $models = ChambreModel::whereHas('reservations', function (Builder $query) use ($dateDebut, $dateFin) {
            $query->where(function ($q) use ($dateDebut, $dateFin) {
                $q->whereDate('date_debut', '<=', $dateFin)
                ->whereDate('date_fin', '>', $dateDebut);
            });
        })->get();

        $entityArray = $models->map(fn ($model) => ChambreModelMapper::toDomain($model))->all();

        return $entityArray;
    }

}