<?php 

namespace App\Domain\Repositories;

use App\Domain\Entities\Paiement;

interface PaiementRepositoryInterface
{
    public function save(Paiement $paiement): Paiement;
}