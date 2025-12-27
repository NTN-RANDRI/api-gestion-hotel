<?php

namespace Database\Seeders;

use App\Models\Chambre;
use App\Models\Client;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();
        $chambres = Chambre::all();
        $types = ['sur_place', 'par_telephone'];

        // Générer 10 réservations
        for ($i = 0; $i < 10; $i++) {
            $client = $clients->random();
            $chambresReservation = $chambres->random(rand(1,3));
            $type = $types[array_rand($types)];

            $dateDebut = Carbon::createFromDate(rand(2024, 2025), rand(1,12), rand(1,28));
            $dateFin = (clone $dateDebut)->addDays(rand(1,5));

            $capaciteMaxTotale = $chambresReservation->sum(function($chambre) {
                return $chambre->typeChambre->capacite_max;
            });

            $nombreNuits = $dateDebut->diffInDays($dateFin);
            $montantTotal = $chambresReservation->sum('prix_nuit') * $nombreNuits;

            // Créer la réservation
            $reservation = Reservation::create([
                'date_debut' => $dateDebut,
                'date_fin' => $dateFin,
                'date_arrivee' => null, // non encore arrivée
                'date_depart' => null,
                'annuler' => null,
                'nombre_personnes' => rand(1, $capaciteMaxTotale),
                'montant_total' => $montantTotal,
                'type' => $type, // ou 'Au comptoir'
                'client_id' => $client->id,
            ]);

            // Lier la chambre à la réservation
            $reservation->chambres()->attach($chambresReservation->pluck('id')->toArray());
        }
    }
}
