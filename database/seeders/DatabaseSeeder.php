<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Crear usuario solo si no existe
        User::firstOrCreate(
            ['email' => 'test@example.com'], // buscar por email
            [
                'name' => 'Test User',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
            ]
        );

        // Llamar a tus seeders
        $this->call([
            CuidadosSeeder::class,
            ProblemasSeeder::class,
            RecomendacionZonaSeeder::class,
            UbicacionesSeeder::class,
            PlantasSeeder::class,
            TratamientosSeeder::class,
            PlantaCuidadosSeeder::class,
        ]);
    }
}