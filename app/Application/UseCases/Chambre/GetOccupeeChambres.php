<?php 

namespace App\Application\UseCases\Chambre;

use App\Application\Mappers\ChambreMapper;
use App\Domain\Entities\Chambre;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\ReservationRepositoryInterface;
use DateTime;

class GetOccupeeChambres
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepo,
    )
    {}

    public function execute(DateTime $dateDebut, DateTime $dateFin): array
    {
        $chambres = $this->chambreRepo->occupee($dateDebut, $dateFin);

        return ChambreMapper::toDTOs($chambres);
    }

}