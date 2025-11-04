<?php

namespace App\Domain\Entities;

class Client
{

    public function __construct(
        private ?int $id,
        private string $nom,
        private string $prenom,
        private string $telephone,
        private string $cin
    ) {}

    // GETTERS
    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getTelephone(): string { return $this->telephone; }
    public function getCin(): string { return $this->cin; }

    // SETTERS
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }
    
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }
    
    public function setTelephone(string $telephone): void
    {
        $this->telephone = $telephone;
    }
    
    public function setCin(string $cin): void
    {
        $this->cin = $cin;
    }

}