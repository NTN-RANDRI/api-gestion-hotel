<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(EquipementSeeder::class);
        $this->call(TypeChambreSeeder::class);
        $this->call(ChambreSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ReservationSeeder::class);
        $this->call(UserSeeder::class);
    }
}
