<?php

namespace App\Domain\Entities;

class TypeChambre
{

    // private array $chambres = [];

    public function __construct(
        private ?int $id,
        private string $nom,
        private int $nombreLits,
        private int $capaciteMax,
        private ?string $description
    )
    {}

    // public function addChambre(Chambre $chambre): void
    // {
    //     $this->chambres[] = $chambre;
    // }

    // public function getChambres(): array
    // {
    //     return $this->chambres;
    // }

    /**
     * Getters
     */
    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getNombreLits(): int { return $this->nombreLits; }
    public function getCapaciteMax(): int { return $this->capaciteMax; }
    public function getDescription(): ?string { return $this->description; }

    /**
     * Setters
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setNombreLits(int $nombreLits): void
    {
        $this->nombreLits = $nombreLits;
    }

    public function setCapaciteMax(string $capaciteMax): void
    {
        $this->capaciteMax = $capaciteMax;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

}