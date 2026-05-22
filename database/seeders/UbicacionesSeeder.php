<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ubicacion;

class UbicacionesSeeder extends Seeder
{
    public function run(): void
    {
        $ubicaciones = [
            [
                'id_usuario' => null,
                'tipo' => 'publico',
                'nombre_lugar' => 'Parque Olímpico',
                'descripcion' => 'Amplias áreas verdes, ideal para árboles frutales y plantas de sol directo.',
                'latitud' => 25.8792,
                'longitud' => -97.5044,
                'es_publica' => true,
            ],
            [
                'id_usuario' => null,
                'tipo' => 'publico',
                'nombre_lugar' => 'Parque Ejidal Las Flores',
                'descripcion' => 'Suelo arcilloso, requiere plantas resistentes a la sequía.',
                'latitud' => 25.8580,
                'longitud' => -97.5129,
                'es_publica' => true,
            ],
            [
                'id_usuario' => null,
                'tipo' => 'publico',
                'nombre_lugar' => 'Jardín del Arte',
                'descripcion' => 'Zona concurrida, ideal para plantas ornamentales en macetas.',
                'latitud' => 25.8725,
                'longitud' => -97.5039,
                'es_publica' => true,
            ],
            [
                'id_usuario' => null,
                'tipo' => 'publico',
                'nombre_lugar' => 'Parque Lineal La Pepsi',
                'descripcion' => 'Suelo arenoso, buen drenaje. Recomendadas plantas nativas.',
                'latitud' => 25.8932,
                'longitud' => -97.4781,
                'es_publica' => true,
            ],
        ];

        foreach ($ubicaciones as $u) {
            Ubicacion::updateOrCreate([
                'nombre_lugar' => $u['nombre_lugar'],
            ], $u);
        }
    }
}
