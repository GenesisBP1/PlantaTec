<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tratamiento;

class TratamientosSeeder extends Seeder
{
    public function run(): void
    {
        // Asociamos tratamientos a problemas (id_problema). Algunos genéricos (id_planta = null)
        // Primero obtenemos los IDs de problemas creados (asumiendo que ya se ejecutó ProblemasSeeder)
        // Es mejor ejecutar este seeder después de ProblemasSeeder.
        $problemas = \App\Models\Problema::all()->keyBy('nombre');
        
        $tratamientos = [
            [
                'id_problema' => $problemas['Ácaros (araña roja)']->id,
                'id_planta' => null,
                'descripcion' => 'Control biológico o químico',
                'indicaciones' => 'Aplicar aceite de neem cada 3 días durante una semana. Aumentar humedad ambiental.'
            ],
            [
                'id_problema' => $problemas['Pulgones']->id,
                'id_planta' => null,
                'descripcion' => 'Eliminación manual y jabón potásico',
                'indicaciones' => 'Pulverizar con agua jabonosa (jabón potásico) cada 2 días. Si es grave, usar insecticida sistémico.'
            ],
            [
                'id_problema' => $problemas['Cochinilla algodonosa']->id,
                'id_planta' => null,
                'descripcion' => 'Eliminación con alcohol y jabón',
                'indicaciones' => 'Aplicar hisopo con alcohol para quitar las cochinillas visibles. Luego pulverizar con aceite de neem.'
            ],
            [
                'id_problema' => $problemas['Mosca blanca']->id,
                'id_planta' => null,
                'descripcion' => 'Trampas amarillas y depredadores',
                'indicaciones' => 'Colocar trampas cromáticas amarillas. Introducir depredadores como Encarsia formosa.'
            ],
            [
                'id_problema' => $problemas['Hongo Mildiú']->id,
                'id_planta' => null,
                'descripcion' => 'Fungicida a base de cobre o azufre',
                'indicaciones' => 'Aplicar cada 7 días hasta control. Evitar humedad en hojas.'
            ],
            [
                'id_problema' => $problemas['Hongo Roya']->id,
                'id_planta' => null,
                'descripcion' => 'Fungicida sistémico',
                'indicaciones' => 'Usar triadimenol o tebuconazol según indicaciones. Eliminar hojas infectadas.'
            ],
            [
                'id_problema' => $problemas['Bacteria (mancha foliar)']->id,
                'id_planta' => null,
                'descripcion' => 'Eliminación y bactericidas de cobre',
                'indicaciones' => 'Podar hojas afectadas. Aplicar cobre en suspensión cada 10 días.'
            ],
            [
                'id_problema' => $problemas['Deficiencia de nitrógeno']->id,
                'id_planta' => null,
                'descripcion' => 'Fertilización nitrogenada',
                'indicaciones' => 'Aplicar fertilizante rico en nitrógeno (ej. humus de lombriz o urea diluida).'
            ],
            [
                'id_problema' => $problemas['Exceso de riego']->id,
                'id_planta' => null,
                'descripcion' => 'Mejorar drenaje y suspender riego',
                'indicaciones' => 'Dejar secar el sustrato. Si hay podredumbre, trasplantar con sustrato nuevo.'
            ],
            [
                'id_problema' => $problemas['Falta de luz']->id,
                'id_planta' => null,
                'descripcion' => 'Reubicación o iluminación artificial',
                'indicaciones' => 'Trasladar la planta a un lugar más iluminado o usar lámparas de crecimiento.'
            ],
        ];

        foreach ($tratamientos as $tratamiento) {
            Tratamiento::create($tratamiento);
        }
    }
}