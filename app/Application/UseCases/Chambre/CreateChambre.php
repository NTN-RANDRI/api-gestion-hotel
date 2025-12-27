<?php

namespace App\Application\UseCases\Chambre;

use App\Application\DTOs\Chambre\ChambreInputDTO;
use App\Application\DTOs\Chambre\ChambreOutputDTO;
use App\Application\Mappers\ChambreMapper;
use App\Application\Services\FileStorageInterface;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Domain\Repositories\EquipementRepositoryInterface;
use App\Domain\Repositories\TypeChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class CreateChambre
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepositoryInterface,
        private TypeChambreRepositoryInterface $typeChambreRepositoryInterface,
        private EquipementRepositoryInterface $equipementRepositoryInterface,
        private FileStorageInterface $fileStorage
    )
    {}

    /**
     * @param \Illuminate\Http\UploadedFile[] $files
     */
    public function execute(ChambreInputDTO $chambreInput, array $files): ChambreOutputDTO
    {
        $typeChambre = $this->typeChambreRepositoryInterface->find($chambreInput->typeChambreId);
        if (!$typeChambre) throw new EntityNotFoundException('TypeChambre');

        $chambre = ChambreMapper::toDomain($chambreInput, $typeChambre);
        $chambre = $this->chambreRepositoryInterface->save($chambre);

        // Ajout Equipements
        foreach ($chambreInput->equipementIds as $equipementId) {
            $equipement = $this->equipementRepositoryInterface->find($equipementId);
            if (!$equipement) throw new EntityNotFoundException("L'équipement #$equipementId est introuvable");

            $this->chambreRepositoryInterface->attachEquipement($chambre, $equipement);
            $chambre->addEquipement($equipement);
        }

        // Ajout Image
        foreach ($files as $file) {
            $filePath = $this->fileStorage->store($file, 'chambres');
            $image = $this->chambreRepositoryInterface->createImage($chambre, $filePath);
            $chambre->addImage($image);
        }

        return ChambreMapper::toDTO($chambre);
    }

}