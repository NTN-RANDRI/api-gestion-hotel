<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Chambre;
use App\Domain\Entities\Equipement;
use App\Domain\Entities\Image;
use DateTime;

interface ChambreRepositoryInterface
{
    public function all(): array;

    public function find(int $id): ?Chambre;
    
    /** @return \App\Domain\Entities\Chambre[] */
    public function findByTypeChambreId(int $typeChambreId): array;

    /** @return \App\Domain\Entities\Chambre[] */
    public function disponible(DateTime $dateDebut, DateTime $dateFin, ?int $reservationIdToIgnore = null): array;

    /** @return \App\Domain\Entities\Chambre[] */
    public function occupee(DateTime $dateDebut, DateTime $dateFin): array;

    public function save(Chambre $entity): Chambre;

    public function delete(int $id): void;

    public function attachEquipement(Chambre $chambre, Equipement $equipement): void;

    /** @param \App\Domain\Entities\Equipement[] $equipements */
    public function syncEquipements(Chambre $chambre, array $equipements): void;

    public function createImage(Chambre $chambre, string $filePath): Image;
}