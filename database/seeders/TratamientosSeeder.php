<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tratamiento;
use App\Models\Problema;
use App\Models\Planta;

class TratamientosSeeder extends Seeder
{
    public function run(): void
    {
        $problemas = Problema::all()->keyBy('nombre');
        $plantas = Planta::all()->keyBy('nombre');

        // Lista de tratamientos (genéricos + específicos para las primeras 6 plantas)
        $tratamientosData = [
            // ========== TRATAMIENTOS GENÉRICOS (para cualquier planta) ==========
            [
                'problema' => 'Ácaros (araña roja)',
                'planta' => null,
                'descripcion' => 'Control biológico o químico',
                'indicaciones' => 'Aplicar aceite de neem cada 3 días durante una semana. Aumentar humedad ambiental.',
                'frecuencia_dias' => 3,
            ],
            [
                'problema' => 'Pulgones',
                'planta' => null,
                'descripcion' => 'Eliminación manual y jabón potásico',
                'indicaciones' => 'Pulverizar con agua jabonosa (jabón potásico) cada 2 días. Si es grave, usar insecticida sistémico.',
                'frecuencia_dias' => 2,
            ],
            [
                'problema' => 'Cochinilla algodonosa',
                'planta' => null,
                'descripcion' => 'Eliminación con alcohol y jabón',
                'indicaciones' => 'Aplicar hisopo con alcohol para quitar las cochinillas visibles. Luego pulverizar con aceite de neem.',
                'frecuencia_dias' => 4,
            ],
            [
                'problema' => 'Mosca blanca',
                'planta' => null,
                'descripcion' => 'Trampas amarillas y depredadores',
                'indicaciones' => 'Colocar trampas cromáticas amarillas. Introducir depredadores como Encarsia formosa.',
                'frecuencia_dias' => 7,
            ],
            [
                'problema' => 'Hongo Mildiú',
                'planta' => null,
                'descripcion' => 'Fungicida a base de cobre o azufre',
                'indicaciones' => 'Aplicar cada 7 días hasta control. Evitar humedad en hojas.',
                'frecuencia_dias' => 7,
            ],
            [
                'problema' => 'Hongo Roya',
                'planta' => null,
                'descripcion' => 'Fungicida sistémico',
                'indicaciones' => 'Usar triadimenol o tebuconazol según indicaciones. Eliminar hojas infectadas.',
                'frecuencia_dias' => 7,
            ],
            [
                'problema' => 'Bacteria (mancha foliar)',
                'planta' => null,
                'descripcion' => 'Eliminación y bactericidas de cobre',
                'indicaciones' => 'Podar hojas afectadas. Aplicar cobre en suspensión cada 10 días.',
                'frecuencia_dias' => 10,
            ],
            [
                'problema' => 'Deficiencia de nitrógeno',
                'planta' => null,
                'descripcion' => 'Fertilización nitrogenada',
                'indicaciones' => 'Aplicar fertilizante rico en nitrógeno (ej. humus de lombriz o urea diluida).',
                'frecuencia_dias' => 14,
            ],
            [
                'problema' => 'Exceso de riego',
                'planta' => null,
                'descripcion' => 'Mejorar drenaje y suspender riego',
                'indicaciones' => 'Dejar secar el sustrato. Si hay podredumbre, trasplantar con sustrato nuevo.',
                'frecuencia_dias' => 1,
            ],
            [
                'problema' => 'Falta de luz',
                'planta' => null,
                'descripcion' => 'Reubicación o iluminación artificial',
                'indicaciones' => 'Trasladar la planta a un lugar más iluminado o usar lámparas de crecimiento.',
                'frecuencia_dias' => 1,
            ],

            // ========== TRATAMIENTOS ESPECÍFICOS PARA LAS PRIMERAS 6 PLANTAS ==========
            // 1. Bouganvilla
            [
                'problema' => 'Ácaros (araña roja)',
                'planta' => 'Bouganvilla',
                'descripcion' => 'Tratamiento específico para Bouganvilla',
                'indicaciones' => 'Pulverizar con aceite de neem + jabón potásico cada 2 días, reforzar con lavado de hojas.',
                'frecuencia_dias' => 2,
            ],
            [
                'problema' => 'Pulgones',
                'planta' => 'Bouganvilla',
                'descripcion' => 'Control biológico para bouganvilla',
                'indicaciones' => 'Introducir larvas de mariquita. Si la plaga es grave, aplicar jabón potásico cada 3 días.',
                'frecuencia_dias' => 3,
            ],
            [
                'problema' => 'Hongo Roya',
                'planta' => 'Bouganvilla',
                'descripcion' => 'Fungicida preventivo',
                'indicaciones' => 'Aplicar caldo bordelés cada 15 días, evitar mojar flores.',
                'frecuencia_dias' => 15,
            ],

            // 2. Ocote (Pino mexicano) – pocos problemas típicos
            [
                'problema' => 'Pulgones',
                'planta' => 'Ocote (Pino mexicano)',
                'descripcion' => 'Control de pulgón en pináceas',
                'indicaciones' => 'Rociar con agua a presión. Usar aceite de verano si hay mucha plaga.',
                'frecuencia_dias' => 5,
            ],

            // 3. Palma real
            [
                'problema' => 'Hongo Mildiú',
                'planta' => 'Palma real',
                'descripcion' => 'Fungicida sistémico para palmeras',
                'indicaciones' => 'Aplicar fosetil-Al cada 10 días. Mejorar ventilación.',
                'frecuencia_dias' => 10,
            ],
            [
                'problema' => 'Deficiencia de nitrógeno',
                'planta' => 'Palma real',
                'descripcion' => 'Abonado específico para palmeras',
                'indicaciones' => 'Usar fertilizante rico en nitrógeno y potasio. Aplicar cada 30 días.',
                'frecuencia_dias' => 30,
            ],

            // 4. Plumeria (Frangipani)
            [
                'problema' => 'Cochinilla algodonosa',
                'planta' => 'Plumeria (Frangipani)',
                'descripcion' => 'Eliminación con alcohol y aceite de neem',
                'indicaciones' => 'Limpiar con hisopo de alcohol. Pulverizar aceite de neem cada 4 días.',
                'frecuencia_dias' => 4,
            ],
            [
                'problema' => 'Hongo Roya',
                'planta' => 'Plumeria (Frangipani)',
                'descripcion' => 'Fungicida a base de cobre',
                'indicaciones' => 'Aplicar oxicloruro de cobre cada 7 días. Retirar hojas afectadas.',
                'frecuencia_dias' => 7,
            ],

            // 5. Agave azul
            [
                'problema' => 'Ácaros (araña roja)',
                'planta' => 'Agave azul',
                'descripcion' => 'Control con azufre',
                'indicaciones' => 'Espolvorear azufre en polvo cada 5 días. Aumentar ventilación.',
                'frecuencia_dias' => 5,
            ],
            [
                'problema' => 'Exceso de riego',
                'planta' => 'Agave azul',
                'descripcion' => 'Suspender riego y mejorar drenaje',
                'indicaciones' => 'No regar durante 15 días. Trasplantar si hay pudrición.',
                'frecuencia_dias' => 1,
            ],

            // 6. Hibisco
            [
                'problema' => 'Mosca blanca',
                'planta' => 'Hibisco',
                'descripcion' => 'Control biológico y trampas',
                'indicaciones' => 'Colocar trampas amarillas. Aplicar jabón potásico cada 3 días.',
                'frecuencia_dias' => 3,
            ],
            [
                'problema' => 'Deficiencia de nitrógeno',
                'planta' => 'Hibisco',
                'descripcion' => 'Fertilización específica para floración',
                'indicaciones' => 'Aplicar fertilizante 20-20-20 cada 15 días.',
                'frecuencia_dias' => 15,
            ],
        ];

        foreach ($tratamientosData as $t) {
            $problema = $problemas[$t['problema']] ?? null;
            if (!$problema) {
                $this->command->warn("Problema '{$t['problema']}' no existe.");
                continue;
            }
            $idProblema = $problema->id;

            $idPlanta = null;
            if ($t['planta'] !== null) {
                $planta = $plantas[$t['planta']] ?? null;
                if (!$planta) {
                    $this->command->warn("Planta '{$t['planta']}' no existe. Tratamiento omitido.");
                    continue;
                }
                $idPlanta = $planta->id;
            }

            Tratamiento::updateOrCreate(
                [
                    'id_problema' => $idProblema,
                    'id_planta' => $idPlanta,
                ],
                [
                    'descripcion' => $t['descripcion'],
                    'indicaciones' => $t['indicaciones'],
                    'frecuencia_dias' => $t['frecuencia_dias'],
                ]
            );
        }

        $this->command->info('TratamientosSeeder completado con tratamientos específicos para las primeras 6 plantas.');
    }
}