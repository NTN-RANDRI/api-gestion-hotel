<?php 

namespace App\Domain\Entities;

use Carbon\Carbon;

class Maintenance
{

    public function __construct(
        private ?int $id,
        private string $dateDebut,
        private string $description,
        private Chambre $chambre,

        private ?string $datePrevus = null,
        private ?string $dateFin = null,
        private ?string $statut = null,
    )
    {}

    // GETTERS
    public function getId(): ?int { return $this->id; }
    public function getDateDebut(): string { return $this->dateDebut; }
    public function getDescription(): string { return $this->description; }
    public function getChambre(): Chambre { return $this->chambre; }
    public function getDateFin(): ?string { return $this->dateFin; }
    public function getDatePrevus(): ?string { return $this->datePrevus; }
    public function getStatut(): string { return $this->statut; }

    // SETTERS
    public function setDateDebut(string $dateDebut): void {
        $this->dateDebut = $dateDebut;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setDatePrevus(?string $datePrevus): void {
        $this->datePrevus = $datePrevus;
    }

    // Méthode publiques
    public function markFinMaintenance(): void {
        $this->dateFin = now()->toDateTimeString();
    }

    public function refreshStatut(): void {
        $today = now();
        $dateDebut = Carbon::parse($this->dateDebut);
        $datePrevus = $this->datePrevus ? Carbon::parse($this->datePrevus) : null;

        if ($this->dateFin) {
            $this->statut = 'Terminée';
            return;
        }

        if ($dateDebut->gt($today)) {
            $this->statut = 'En attente';
            return;
        }

        if ($datePrevus && $datePrevus->lt($today)) {
            $this->statut = 'En retard';
            return;
        }

        if ($dateDebut->lte($today)) {
            $this->statut = 'En cours';
            return;
        }

        $this->statut = 'Inconnue';
    }

}