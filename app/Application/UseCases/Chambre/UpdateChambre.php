<?php

namespace App\Application\UseCases\Chambre;

use App\Application\DTOs\Chambre\ChambreInputDTO;
use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\Mappers\ChambreMapper;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Domain\Repositories\ReservationRepositoryInterface;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class UpdateChambre
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepo,
        private TypeChambreRepositoryInterface $typeChambreRepo,
        private EquipementRepositoryInterface $equipementRepo,
    )
    {}

    public function execute(int $id, ChambreInputDTO $chambreInput): ChambreOutputDTO
    {
        $chambre = $this->chambreRepo->find($id);
        if (!$chambre) { throw new EntityNotFoundException('Chambre'); }

        $typeChambre = $this->typeChambreRepo->find($chambreInput->typeChambreId);
        if (!$typeChambre) { throw new EntityNotFoundException('TypeChambre'); }

        // update chambre
        $chambre->setNumero($chambreInput->numero);
        $chambre->setPrixNuit($chambreInput->prixNuit);
        $chambre->setDescription($chambreInput->description);
        $chambre->setTypeChambre($typeChambre);
        $chambre = $this->chambreRepo->save($chambre);

        // update Equipement
        $equipements = array_map(function ($equipementId) {
            return $this->equipementRepo->find($equipementId);
        }, $chambreInput->equipementIds);

        $this->chambreRepo->syncEquipements($chambre, $equipements);
        $chambre->updateEquipement($equipements);

        return ChambreMapper::toDTO($chambre);

    }

}