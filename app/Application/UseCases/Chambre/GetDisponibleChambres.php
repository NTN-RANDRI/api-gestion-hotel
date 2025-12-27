<?php

namespace App\Application\UseCases\Chambre;

use App\Application\Mappers\ChambreMapper;
use App\Domain\Entities\Chambre;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\ReservationRepositoryInterface;
use DateTime;

class GetDisponibleChambres
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepo,
    )
    {}

    public function execute(DateTime $dateDebut, DateTime $dateFin, ?int $reservationIdToIgnore = null): array
    {
        $chambres = $this->chambreRepo->disponible($dateDebut, $dateFin, $reservationIdToIgnore);

        return ChambreMapper::toDTOs($chambres);
    }

}