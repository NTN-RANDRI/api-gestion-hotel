<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $personnel = Personnel::create([
            'nom' => 'RASOLO',
            'prenom' => 'Rasolo',
            'telephone' => '0325875412',
            'role' => 'Administrateur'
        ]);

        $user = [
            'email' => 'admin@gmail.com',
            'password' => 'admin123'
        ];

        $personnel->user()->create($user);

        $client = Client::create([
            'nom' => 'RANDRI',
            'prenom' => 'Ntn',
            'telephone' => '0345685216',
            'cin' => '123486952123',
        ]);

        $user = [
            'email' => 'ntn@gmail.com',
            'password' => 'ntn123'
        ];

        $client->user()->create($user);
    }
}
