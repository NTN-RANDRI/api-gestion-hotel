<?php

namespace App\Application\UseCases\TypeChambre;

use App\Domain\Repositories\TypeChambreRepositoryInterface;

class CreateTypeChambre
{

    public function __construct(private TypeChambreRepositoryInterface $typeChambreRepositoryInterface)
    {}

    public function execute()
    {
        //
    }

}