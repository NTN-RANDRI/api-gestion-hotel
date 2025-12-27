<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Chambre;
use App\Models\Chambre as ChambreModel;
use Illuminate\Database\Eloquent\Collection;

class ChambreModelMapper
{

    public static function toArray(Chambre $entity): array
    {
        return [
            'numero' => $entity->getNumero(),
            'prix_nuit' => $entity->getPrixNuit(),
            'description' => $entity->getDescription(),
            'type_chambre_id' => $entity->getTypeChambre()->getId(),
        ];
    }

    public static function toDomain(ChambreModel $model): Chambre
    {
        $typeChambre = TypeChambreModelMapper::toDomain($model->typeChambre);
        $equipements = EquipementModelMapper::toDomains($model->equipements);
        $images = ImageModelMapper::toDomains($model->images);

        $chambre = new Chambre(
            id: $model->id,
            numero: $model->numero,
            prixNuit: $model->prix_nuit,
            description: $model->description,
            typeChambre: $typeChambre,
            equipements: $equipements,
            images: $images,
            statut: $model->statut
        );

        return $chambre;
    }

    /**
     * @return \App\Domain\Entities\Chambre[]
     */
    public static function toDomains(Collection $models): array
    {
        $chambres = $models->map(fn ($model) => self::toDomain($model))->all();

        return $chambres;
    }

}