<?php

namespace Database\Seeders;

use App\Models\Chambre;
use App\Models\Equipement;
use App\Models\TypeChambre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChambreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = TypeChambre::all();
        $equipements = Equipement::all();

        // Numéros de chambre (101 à 110)
        $numeros = range(101, 110);

        foreach ($numeros as $numero) {
            // Choisir un type de chambre aléatoire
            $type = $types->random();

            // Créer la chambre
            $chambre = Chambre::create([
                'numero' => (string)$numero,
                'prix_nuit' => rand(30000, 100000), // prix aléatoire entre 50 et 200
                'description' => fake()->text(100),
                'type_chambre_id' => $type->id,
            ]);

            // Associer 2 à 3 équipements aléatoires
            $chambre->equipements()->attach(
                $equipements->random(rand(2, 3))->pluck('id')->toArray()
            );
        }
    }
}
