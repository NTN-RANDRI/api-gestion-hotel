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

        private ?array $equipements = null,
        private ?array $images = null,
        private ?string $statut = null,
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
    public function getEquipements(): array { return $this->equipements; }
    public function getImages(): array { return $this->images; }
    public function getStatut(): string { return $this->statut; }


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

    public function setStatut(string $statut): void
    {
        $this->statut = $statut;
    }

    // Méthode publiques
    public function addEquipement(Equipement $equipement): void
    {
        $this->equipements[] = $equipement;
    }

    /** @param Equipement[] $equipements */
    public function addManyEquipements(array $equipements): void
    {
        foreach ($equipements as $equipement) {
            $this->addEquipement($equipement);
        }
    }

    /** @param Equipement[] $equipements */
    public function updateEquipement(array $equipements): void
    {
        $this->equipements = $equipements;
    }

    public function addImage(Image $image): void
    {
        $this->images[] = $image;
    }

    /** @param Image[] $images */
    public function addManyImage(array $images): void
    {   
        foreach ($images as $image) {
            $this->addImage($image);
        }
    }

}