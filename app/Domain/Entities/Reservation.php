<?php

namespace App\Domain\Entities;

use Carbon\Carbon;
use DateTime;
use Exception;

class Reservation
{

    /**
     * @param \App\Domain\Entities\Paiement[] $paiements
     * @param \App\Domain\Entities\Chambre[] $chambres
     */
    public function __construct(
        private ?int $id,
        private string $dateDebut,
        private string $dateFin,
        private int $nombrePersonnes,
        private string $type,
        private Client $client,

        private ?int $montantTotal = null,
        private ?string $dateReservation = null,
        private ?string $dateArrivee = null,
        private ?string $dateDepart = null,
        private ?array $paiements = null,
        private ?array $chambres = null,
        private ?string $annuler = null,
        private ?string $statut = null,
        private ?int $montantRestant = null,
    )
    {}

    // GETTERS 
    public function getId(): ?int { return $this->id; }
    public function getDateDebut(): string { return $this->dateDebut; }
    public function getDateFin(): string { return $this->dateFin; }
    public function getDateReservation(): string { return $this->dateReservation; }
    public function getNombrePersonnes(): int { return $this->nombrePersonnes; }
    public function getMontantTotal(): int { return $this->montantTotal; }
    public function getType(): string { return $this->type; }
    public function getStatut(): ?string { return $this->statut; }
    public function getClient(): Client { return $this->client; }
    public function getDateArrivee(): ?string { return $this->dateArrivee; }
    public function getDateDepart(): ?string { return $this->dateDepart; }
    public function getMontantRestant(): ?int { return $this->montantRestant; }
    public function getAnnuler(): ?string { return $this->annuler; }

    /** @return \App\Domain\Entities\Chambre[] */
    public function getChambres(): array { return $this->chambres; }

    /** @return \App\Domain\Entities\Paiement[] */
    public function getPaiements(): array { return $this->paiements; }

    private function getNombreNuit(): int {
        $debut = new DateTime($this->dateDebut);
        $fin = new DateTime($this->dateFin);

        return $debut->diff($fin)->days;
    }

    // SETTERS
    public function setDateDebut(string $dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    public function setDateFin(string $dateFin): void 
    {
        $this->dateFin = $dateFin;
    }

    public function setDateReservation(string $dateReservation): void 
    {
        $this->dateReservation = $dateReservation;
    }

    public function setNombrePersonnes(int $nombrePersonnes): void 
    {
        $this->nombrePersonnes = $nombrePersonnes;
    }

    public function setType(string $type): void 
    {
        $this->type = $type;
    }

    public function setStatut(string $statut): void 
    {
        $this->statut = $statut;
    }

    public function setClient(Client $client): void 
    {
        $this->client = $client;
    }

    public function addChambre(Chambre $chambre): void 
    {
        $this->chambres[] = $chambre;
    }

    /** @param Chambre[] $chambres */
    public function addManyChambres(array $chambres): void
    {
        foreach ($chambres as $chambre) {
            $this->addChambre($chambre);
        }
    }
    
    /** @param Chambre[] $chambres */
    public function updateChambres(array $chambres): void
    {
        $this->resetChambres();
        $this->addManyChambres($chambres);
    }

    public function addPaiement(Paiement $paiement): void 
    {
        $this->paiements[] = $paiement;
    }

    /** @param Paiement[] $paiements */
    public function addManyPaiements(array $paiements): void
    {
        foreach ($paiements as $paiement) {
            $this->addPaiement($paiement);
        }
    }

    public function calculMontantTotal(): void
    {
        $this->montantTotal = array_reduce($this->chambres, fn ($sum, $chambre) => $sum + $chambre->getPrixNuit() * $this->getNombreNuit(), 0);
    }

    public function checkIn(): void {
        if ($this->dateArrivee) throw new Exception("Check-In echec, date arrivee a deja un valeur");

        $today = Carbon::now();
        $dateDebut = Carbon::parse($this->dateDebut);

        if ($today->lt($dateDebut)) throw new Exception("Check-In refusé, la date de début n'est pas encore arrivée");

        $this->dateArrivee = $today->toDateTimeString();
    }

    public function checkOut(): void {
        if ($this->dateDepart) throw new Exception("Check-Out echec, date depart a deja un valeur");
        if (!$this->dateArrivee) throw new Exception("Check-Out echec, date arrivee encore null");

        if ($this->montantRestant > 0) throw new Exception("Check-Out refusé, il reste encore montant à payer");

        $today = Carbon::now();

        $this->dateDepart = $today->toDateTimeString();
    }

    // Méthode privées
    private function resetChambres(): void
    {
        $this->chambres = [];
    }

}