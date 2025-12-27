<?php

namespace Database\Seeders;

use App\Models\TypeChambre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeChambreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $typesChambres = [
            [
                'nom' => 'Simple',
                'nombre_lits' => 1,
                'capacite_max' => 1,
                'description' => 'Chambre pour une personne avec lit simple',
            ],
            [
                'nom' => 'Double',
                'nombre_lits' => 1,
                'capacite_max' => 2,
                'description' => 'Chambre pour deux personnes avec lit double',
            ],
            [
                'nom' => 'Twin',
                'nombre_lits' => 2,
                'capacite_max' => 2,
                'description' => 'Chambre avec deux lits simples séparés',
            ],
            [
                'nom' => 'Familiale',
                'nombre_lits' => 3,
                'capacite_max' => 4,
                'description' => 'Chambre spacieuse adaptée aux familles',
            ],
            [
                'nom' => 'Suite',
                'nombre_lits' => 2,
                'capacite_max' => 4,
                'description' => 'Suite de luxe avec espace salon',
            ],
        ];

        foreach ($typesChambres as $type) {
            TypeChambre::create($type);
        }
    }
}
