<?php

namespace App\Domain\Entities;

class Chambre
{

    public function __construct(
        private ?int $id,
        private string $numero,
        private int $prixNuit,
        private ?string $description,
        private TypeChambre $typeChambre
    )
    {}

    /**
     * Getters
     */
    public function getId(): ?int { return $this->id; }
    public function getNumero(): string { return $this->numero; }
    public function getPrixNuit(): int { return $this->prixNuit; }
    public function getDescription(): ?string { return $this->description; }
    public function getTypeChambre(): TypeChambre { return $this->typeChambre; }

    /**
     * Setters
     */
    public function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }

    public function setPrixNuit(int $prixNuit): void
    {
        $this->prixNuit = $prixNuit;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setTypeChambre(TypeChambre $typeChambre): void
    {
        $this->typeChambre = $typeChambre;
    }

}