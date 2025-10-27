<?php

namespace App\Domain\Entities;

class Chambre
{

    public function __construct(
        private ?int $id,
        private string $numero,
        private int $prixNuit,
        private ?string $description,
        private TypeChambre $typeChambre,
        private array $equipements,
        private array $images
    )
    {
        foreach ($equipements as $e) {
            if (!$e instanceof \App\Domain\Entities\Equipement) {
                throw new \InvalidArgumentException('Tous les éléments de $equipements doivent être des instances de Equipement');
            }
        }
    }

    /**
     * Getters
     */
    public function getId(): ?int { return $this->id; }
    public function getNumero(): string { return $this->numero; }
    public function getPrixNuit(): int { return $this->prixNuit; }
    public function getDescription(): ?string { return $this->description; }
    public function getTypeChambre(): TypeChambre { return $this->typeChambre; }
    public function getEquipements(): array { return $this->equipements; }
    public function getImages(): array { return $this->images; }

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

    public function setEquipements(array $equipements): void
    {
        $this->equipements = $equipements;
    }

    public function addImage(Image $image): void
    {
        $this->images[] = $image;
    }

}