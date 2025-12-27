<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\Paiement;
use App\Domain\Repositories\PaiementRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\PaiementModelMapper;
use App\Models\Paiement as PaiementModel;

class PaiementRepository implements PaiementRepositoryInterface
{

    public function save(Paiement $paiement): Paiement
    {
        $paiementModel = PaiementModel::create(PaiementModelMapper::toArray($paiement))->fresh();

        return PaiementModelMapper::toDomain($paiementModel);
    }

}