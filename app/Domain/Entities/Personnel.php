<?php

namespace App\Domain\Entities;

class Personnel
{

    public function __construct(
        private ?int $id,
        private string $nom,
        private string $prenom,
        private string $telephone,
        private string $role,

        private ?User $user = null,
    )
    {}

    // GETTERS
    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getTelephone(): string { return $this->telephone; }
    public function getRole(): string { return $this->role; }
    public function getUser(): ?User { return $this->user; }

    // METHODE PUBLIQUES
    public function update(
        ?string $nom = null,
        ?string $prenom = null,
        ?string $telephone = null,
        ?string $role = null,
    )
    {
        if ($nom) $this->nom = $nom;
        if ($prenom) $this->prenom = $prenom;
        if ($telephone) $this->telephone = $telephone;
        if ($role) $this->role = $role;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}