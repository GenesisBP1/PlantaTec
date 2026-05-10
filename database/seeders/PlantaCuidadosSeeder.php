<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Planta;
use App\Models\Cuidado;
use App\Models\PlantaCuidado;

class PlantaCuidadosSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener los cuidados por nombre para facilitar la asignación
        $cuidados = Cuidado::pluck('id', 'nombre')->toArray();

        // Definir los cuidados para cada planta (solo los que realmente necesita)
        $asignaciones = [
            'Bouganvilla' => [
                ['cuidado' => 'Riego', 'frecuencia' => 7, 'instrucciones_esp' => 'Riego moderado, dejar secar entre riegos.'],
                ['cuidado' => 'Poda', 'frecuencia' => 30, 'instrucciones_esp' => 'Podar después de floración para estimular nuevas flores.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 45, 'instrucciones_esp' => 'Fertilizante balanceado cada mes y medio.'],
            ],
            'Ocote (Pino mexicano)' => [
                ['cuidado' => 'Riego', 'frecuencia' => 14, 'instrucciones_esp' => 'Riego profundo cada dos semanas.'],
                ['cuidado' => 'Poda', 'frecuencia' => 180, 'instrucciones_esp' => 'Poda de formación cada 6 meses.'],
            ],
            'Palma real' => [
                ['cuidado' => 'Riego', 'frecuencia' => 5, 'instrucciones_esp' => 'Riego frecuente, mantener suelo húmedo.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 60, 'instrucciones_esp' => 'Fertilizante para palmas cada 2 meses.'],
                ['cuidado' => 'Limpieza', 'frecuencia' => 30, 'instrucciones_esp' => 'Retirar hojas secas.'],
            ],
            'Plumeria (Frangipani)' => [
                ['cuidado' => 'Riego', 'frecuencia' => 7, 'instrucciones_esp' => 'Riego moderado, tolera sequía.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 30, 'instrucciones_esp' => 'Fertilizante alto en fósforo para floración.'],
            ],
            'Agave azul' => [
                ['cuidado' => 'Riego', 'frecuencia' => 21, 'instrucciones_esp' => 'Riego escaso, resistente a sequía.'],
                ['cuidado' => 'Limpieza', 'frecuencia' => 60, 'instrucciones_esp' => 'Retirar hojas viejas de la base.'],
            ],
            'Hibisco' => [
                ['cuidado' => 'Riego', 'frecuencia' => 3, 'instrucciones_esp' => 'Riego abundante, mantener húmedo.'],
                ['cuidado' => 'Poda', 'frecuencia' => 45, 'instrucciones_esp' => 'Poda ligera para dar forma.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 20, 'instrucciones_esp' => 'Fertilizante rico en potasio cada 3 semanas.'],
            ],
            'Crotón' => [
                ['cuidado' => 'Riego', 'frecuencia' => 5, 'instrucciones_esp' => 'Riego regular, no encharcar.'],
                ['cuidado' => 'Limpieza de hojas', 'frecuencia' => 15, 'instrucciones_esp' => 'Limpiar hojas con paño húmedo.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 30, 'instrucciones_esp' => 'Fertilizante líquido cada mes.'],
            ],
            'Duranta (Violeta)' => [
                ['cuidado' => 'Riego', 'frecuencia' => 7, 'instrucciones_esp' => 'Riego moderado.'],
                ['cuidado' => 'Poda', 'frecuencia' => 60, 'instrucciones_esp' => 'Poda para controlar tamaño.'],
            ],
            'Lantana' => [
                ['cuidado' => 'Riego', 'frecuencia' => 7, 'instrucciones_esp' => 'Tolerante, riego cada semana.'],
                ['cuidado' => 'Poda', 'frecuencia' => 90, 'instrucciones_esp' => 'Poda de rejuvenecimiento cada 3 meses.'],
            ],
            'Nochebuena (Poinsettia)' => [
                ['cuidado' => 'Riego', 'frecuencia' => 5, 'instrucciones_esp' => 'Riego cuando la superficie esté seca.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 15, 'instrucciones_esp' => 'Fertilizante cada 15 días en crecimiento.'],
            ],
            'Yuca' => [
                ['cuidado' => 'Riego', 'frecuencia' => 14, 'instrucciones_esp' => 'Riego espaciado, resistente.'],
                ['cuidado' => 'Limpieza', 'frecuencia' => 30, 'instrucciones_esp' => 'Retirar hojas inferiores secas.'],
            ],
            'Sábila (Aloe vera)' => [
                ['cuidado' => 'Riego', 'frecuencia' => 14, 'instrucciones_esp' => 'Riego profundo cada 2 semanas.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 60, 'instrucciones_esp' => 'Fertilizante para suculentas.'],
            ],
            'Cedro limón' => [
                ['cuidado' => 'Riego', 'frecuencia' => 7, 'instrucciones_esp' => 'Riego regular en época seca.'],
                ['cuidado' => 'Poda', 'frecuencia' => 90, 'instrucciones_esp' => 'Poda de formación cada 3 meses.'],
            ],
            'Jazmín del Cabo' => [
                ['cuidado' => 'Riego', 'frecuencia' => 5, 'instrucciones_esp' => 'Mantener suelo húmedo nunca encharcado.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 20, 'instrucciones_esp' => 'Fertilizante ácido cada 20 días.'],
            ],
            'Mango' => [
                ['cuidado' => 'Riego', 'frecuencia' => 7, 'instrucciones_esp' => 'Riego durante floración y fructificación.'],
                ['cuidado' => 'Poda', 'frecuencia' => 180, 'instrucciones_esp' => 'Poda después de cosecha.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 60, 'instrucciones_esp' => 'Fertilizante rico en nitrógeno.'],
            ],
            'Papaya' => [
                ['cuidado' => 'Riego', 'frecuencia' => 4, 'instrucciones_esp' => 'Riego frecuente, no tolera sequía.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 30, 'instrucciones_esp' => 'Fertilizante completo cada mes.'],
            ],
            'Cítricos (Naranjo)' => [
                ['cuidado' => 'Riego', 'frecuencia' => 7, 'instrucciones_esp' => 'Riego moderado, evitar encharcamiento.'],
                ['cuidado' => 'Poda', 'frecuencia' => 90, 'instrucciones_esp' => 'Poda de limpieza cada 3 meses.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 45, 'instrucciones_esp' => 'Fertilizante cítricos.'],
            ],
            'Helecho de Boston' => [
                ['cuidado' => 'Riego', 'frecuencia' => 3, 'instrucciones_esp' => 'Mantener humedad constante.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 15, 'instrucciones_esp' => 'Fertilizante líquido cada 15 días.'],
                ['cuidado' => 'Limpieza', 'frecuencia' => 7, 'instrucciones_esp' => 'Eliminar frondas secas.'],
            ],
            'Sansevieria (Lengua de suegra)' => [
                ['cuidado' => 'Riego', 'frecuencia' => 21, 'instrucciones_esp' => 'Riego muy espaciado, resistente.'],
                ['cuidado' => 'Limpieza', 'frecuencia' => 30, 'instrucciones_esp' => 'Limpiar hojas con paño seco.'],
            ],
            'Rosal' => [
                ['cuidado' => 'Riego', 'frecuencia' => 4, 'instrucciones_esp' => 'Riego abundante en verano.'],
                ['cuidado' => 'Poda', 'frecuencia' => 60, 'instrucciones_esp' => 'Poda de formación cada 2 meses.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 20, 'instrucciones_esp' => 'Fertilizante para rosas.'],
            ],
            'Buganvilia (enana)' => [
                ['cuidado' => 'Riego', 'frecuencia' => 7, 'instrucciones_esp' => 'Riego moderado, secar entre riegos.'],
                ['cuidado' => 'Poda', 'frecuencia' => 30, 'instrucciones_esp' => 'Poda para mantener compacta.'],
            ],
            'Pata de elefante' => [
                ['cuidado' => 'Riego', 'frecuencia' => 14, 'instrucciones_esp' => 'Riego espaciado, almacena agua.'],
                ['cuidado' => 'Limpieza', 'frecuencia' => 30, 'instrucciones_esp' => 'Limpiar hojas.'],
            ],
            'Cuerno de alce' => [
                ['cuidado' => 'Riego', 'frecuencia' => 5, 'instrucciones_esp' => 'Rociar sobre las hojas, no encharcar.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 30, 'instrucciones_esp' => 'Fertilizante diluido cada mes.'],
            ],
            'Oreja de elefante' => [
                ['cuidado' => 'Riego', 'frecuencia' => 4, 'instrucciones_esp' => 'Mantener húmedo, alta humedad.'],
                ['cuidado' => 'Limpieza', 'frecuencia' => 7, 'instrucciones_esp' => 'Limpiar hojas grandes.'],
            ],
            'Cactus de Navidad' => [
                ['cuidado' => 'Riego', 'frecuencia' => 10, 'instrucciones_esp' => 'Riego moderado, menos en invierno.'],
                ['cuidado' => 'Fertilización', 'frecuencia' => 30, 'instrucciones_esp' => 'Fertilizante para cactus en primavera.'],
            ],
        ];

        // Procesar asignaciones
        foreach ($asignaciones as $nombrePlanta => $cuidadosList) {
            $planta = Planta::where('nombre', $nombrePlanta)->first();
            if (!$planta) continue;

            foreach ($cuidadosList as $cuidadoData) {
                $cuidadoId = $cuidados[$cuidadoData['cuidado']] ?? null;
                if (!$cuidadoId) continue;

                PlantaCuidado::updateOrCreate(
                    [
                        'id_planta' => $planta->id,
                        'id_cuidado' => $cuidadoId,
                    ],
                    [
                        'frecuencia' => $cuidadoData['frecuencia'],
                        'instrucciones_esp' => $cuidadoData['instrucciones_esp'],
                    ]
                );
            }
        }
    }
}