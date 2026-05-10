<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecomendacionZona;

class RecomendacionZonaSeeder extends Seeder
{
    public function run(): void
    {
        $zonas = [
            [
                'nombre_lugar' => 'Parque Olímpico',
                'tipo_zona'    => 'Parque urbano',
                'indicaciones' => 'Amplias áreas verdes, ideal para árboles frutales y plantas de sol directo.',
                'latitud'      => 25.8792,
                'longitud'     => -97.5044,
                'descripcion'  => 'Uno de los parques más grandes de Matamoros, con senderos y zonas deportivas.',
            ],
            [
                'nombre_lugar' => 'Parque Ejidal "Las Flores"',
                'tipo_zona'    => 'Parque comunitario',
                'indicaciones' => 'Suelo arcilloso, requiere plantas resistentes a la sequía.',
                'latitud'      => 25.8580,
                'longitud'     => -97.5129,
                'descripcion'  => 'Espacio con juegos infantiles y bancas, rodeado de viviendas.',
            ],
            [
                'nombre_lugar' => 'Jardín del Arte (Plaza Principal)',
                'tipo_zona'    => 'Jardín público',
                'indicaciones' => 'Zona concurrida, ideal para plantas ornamentales en macetas.',
                'latitud'      => 25.8725,
                'longitud'     => -97.5039,
                'descripcion'  => 'Cerca del Palacio Municipal, con fuentes y áreas de descanso.',
            ],
            [
                'nombre_lugar' => 'Parque Lineal "La Pepsi"',
                'tipo_zona'    => 'Corredor ecológico',
                'indicaciones' => 'Suelo arenoso, buen drenaje. Recomendadas plantas nativas.',
                'latitud'      => 25.8932,
                'longitud'     => -97.4781,
                'descripcion'  => 'Sendero peatonal con árboles establecidos y áreas de ejercicio.',
            ],
            [
                'nombre_lugar' => 'Bosque Urbano "El Refugio"',
                'tipo_zona'    => 'Bosque urbano',
                'indicaciones' => 'Sombra parcial, ideal para helechos y plantas de interior/exterior adaptadas.',
                'latitud'      => 25.8421,
                'longitud'     => -97.5194,
                'descripcion'  => 'Zona protegida con flora y fauna local, se permiten actividades de reforestación.',
            ],
            [
                'nombre_lugar' => 'Parque "Fidel Velázquez"',
                'tipo_zona'    => 'Parque recreativo',
                'indicaciones' => 'Área con juegos y canchas, suelo compacto.',
                'latitud'      => 25.8856,
                'longitud'     => -97.4960,
                'descripcion'  => 'Popular para caminatas matutinas, con áreas verdes abiertas.',
            ],
            [
                'nombre_lugar' => 'Jardín Botánico "Matamoros"',
                'tipo_zona'    => 'Jardín botánico',
                'indicaciones' => 'Proyecto en desarrollo, suelo enriquecido. Ideal para especies nativas y ornamentales.',
                'latitud'      => 25.8685,
                'longitud'     => -97.5082,
                'descripcion'  => 'Espacio dedicado a la conservación de plantas de la región.',
            ],
            [
                'nombre_lugar' => 'Parque "Hidalgo"',
                'tipo_zona'    => 'Plaza cívica',
                'indicaciones' => 'Poco riego disponible, plantas resistentes a la sequía.',
                'latitud'      => 25.8730,
                'longitud'     => -97.5021,
                'descripcion'  => 'Zona céntrica con monumentos históricos y bancas.',
            ],
            [
                'nombre_lugar' => 'Camellón "Periférico"',
                'tipo_zona'    => 'Área de camellón',
                'indicaciones' => 'Exposición total al sol, viento constante. Plantas de porte bajo y resistentes.',
                'latitud'      => 25.8915,
                'longitud'     => -97.4728,
                'descripcion'  => 'Franja verde que recorre el periférico de la ciudad.',
            ],
            [
                'nombre_lugar' => 'Parque "Luis Donaldo Colosio"',
                'tipo_zona'    => 'Parque de barrio',
                'indicaciones' => 'Suelo arcillo‑arenoso, buen espacio para árboles frutales.',
                'latitud'      => 25.8647,
                'longitud'     => -97.5223,
                'descripcion'  => 'Área recreativa con canchas de fútbol y áreas verdes.',
            ],
        ];

        foreach ($zonas as $zona) {
            RecomendacionZona::updateOrCreate(
                ['nombre_lugar' => $zona['nombre_lugar']], // evita duplicados por nombre
                $zona
            );
        }
    }
}