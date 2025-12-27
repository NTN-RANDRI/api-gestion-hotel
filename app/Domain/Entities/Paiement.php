<?php

namespace App\Domain\Entities;

class Paiement
{

    public function __construct(
        private ?int $id,
        private int $montant,
        private string $mode,
        
        private ?string $telephone = null,
        private string $statut = 'reussi',
        private ?string $datePaiement = null,
    )
    {}

    // GETTERS
    public function getId(): ?int { return $this->id; }
    public function getMontant(): int { return $this->montant; }
    public function getMode(): string { return $this->mode; }
    public function getTelephone(): ?string { return $this->telephone; }
    public function getStatut(): string { return $this->statut; }
    public function getDatePaiement(): string { return $this->datePaiement; }

}