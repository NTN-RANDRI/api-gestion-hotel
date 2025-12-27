<?php

namespace App\Application\UseCases\Chambre;

use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\Mappers\ChambreMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class GetChambreById
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepo,
    )
    {}

    public function execute(int $id): ChambreOutputDTO
    {
        $chambre = $this->chambreRepo->find($id);
        if (!$chambre) throw new EntityNotFoundException('Chambre');

        return ChambreMapper::toDTO($chambre);
    }

}