<?php

namespace App\Application\UseCases\Chambre;

use App\Application\Mappers\ChambreMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;

class ListChambre
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepo,
    )
    {}

    public function execute(): array
    {
        $chambres = $this->chambreRepo->all();

        return ChambreMapper::toDTOs($chambres);
    }

}