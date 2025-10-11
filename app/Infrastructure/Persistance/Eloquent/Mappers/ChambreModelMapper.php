<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Chambre;
use App\Domain\Entities\TypeChambre;
use App\Models\Chambre as ChambreModel;

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

    public static function toModel(Chambre $entity): ChambreModel
    {
        return new ChambreModel([
            'id' => $entity->getId(),
            'numero' => $entity->getNumero(),
            'prix_nuit' => $entity->getPrixNuit(),
            'description' => $entity->getDescription(),
            'type_chambre_id' => $entity->getTypeChambre()->getId(),
        ]);
    }

    public static function toDomain(ChambreModel $model): Chambre
    {
        $typeChambreModel = $model->typeChambre;

        $typeChambre = new TypeChambre(
            id: $typeChambreModel->id,
            nom: $typeChambreModel->nom,
            nombreLits: $typeChambreModel->nombre_lits,
            capaciteMax: $typeChambreModel->capacite_max,
            description: $typeChambreModel->description,
        );

        return new Chambre(
            id: $model->id,
            numero: $model->numero,
            prixNuit: $model->prix_nuit,
            description: $model->description,
            typeChambre: $typeChambre
        );
    }

}