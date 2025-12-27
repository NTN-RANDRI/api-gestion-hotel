<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prenoms = ['Hery', 'Miora', 'Jean', 'Fara', 'Sitraka', 'Noro', 'Lova', 'Mamy', 'Tiana', 'Rija'];
        $noms = ['Rakoto', 'Rabe', 'Randrian', 'Andrian', 'Rasoa', 'Ramaroson', 'Ramiandrisoa', 'Ravelo', 'Razaf', 'Rasendran'];

        for ($i = 0; $i < 10; $i++) {
            $prenom = $prenoms[array_rand($prenoms)];
            $nom = $noms[array_rand($noms)];

            // Téléphone Madagascar : commence par 034, 032, 033, suivi de 7 chiffres
            $prefixes = ['034', '032', '033'];
            $telephone = $prefixes[array_rand($prefixes)] . rand(1000000, 9999999);

            // CIN : 12 chiffres aléatoires
            $cin = str_pad(rand(0, 999999999999), 12, '0', STR_PAD_LEFT);

            Client::create([
                'nom' => $nom,
                'prenom' => $prenom,
                'telephone' => $telephone,
                'cin' => $cin,
            ]);
        }
    }
}
