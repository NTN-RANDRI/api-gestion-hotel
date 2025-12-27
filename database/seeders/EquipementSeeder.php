<?php

namespace Database\Seeders;

use App\Models\Equipement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipements = [
            [
                'nom' => 'Wi-Fi',
                'description' => 'Connexion internet sans fil disponible dans tout l’hôtel',
            ],
            [
                'nom' => 'Climatisation',
                'description' => 'Système de climatisation réglable dans la chambre',
            ],
            [
                'nom' => 'Télévision',
                'description' => 'Télévision écran plat avec chaînes locales et internationales',
            ],
            [
                'nom' => 'Mini-bar',
                'description' => 'Mini réfrigérateur avec boissons et snacks',
            ],
            [
                'nom' => 'Coffre-fort',
                'description' => 'Coffre sécurisé pour objets de valeur',
            ],
        ];

        foreach ($equipements as $equipement) {
            Equipement::create($equipement);
        }
    }
}
