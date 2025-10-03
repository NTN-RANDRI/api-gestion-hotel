<?php

namespace App\Domain\Entities;

class Equipement
{

    public function __construct(
        private ?int $id,
        private string $nom,
        private ?string $description
    )
    {}

    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getDescription(): ?string { return $this->description; }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

}