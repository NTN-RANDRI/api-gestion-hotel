<?php

namespace App\Application\UseCases\Chambre;

use App\Application\Mappers\ChambreRequestMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;

class ListChambre
{

    public function __construct(private ChambreRepositoryInterface $chambreRepositoryInterface)
    {}

    public function execute(): array
    {
        $entityCollection = $this->chambreRepositoryInterface->all();

        return array_map(fn($entity) => ChambreRequestMapper::toDTO($entity), $entityCollection);
    }

}