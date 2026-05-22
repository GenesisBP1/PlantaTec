<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuidado;

class CuidadosSeeder extends Seeder
{
    public function run(): void
    {
        $cuidados = [
            ['nombre' => 'Riego', 'descripcion' => 'Aplicación de agua según necesidad de la planta.'],
            ['nombre' => 'Poda', 'descripcion' => 'Corte de ramas secas, enfermas o para dar forma.'],
            ['nombre' => 'Fertilización', 'descripcion' => 'Aporte de nutrientes orgánicos o químicos.'],
            ['nombre' => 'Control de plagas', 'descripcion' => 'Aplicación de insecticidas o métodos biológicos.'],
            ['nombre' => 'Control de hongos', 'descripcion' => 'Uso de fungicidas para prevenir o curar enfermedades fúngicas.'],
            ['nombre' => 'Limpieza de hojas', 'descripcion' => 'Retiro de polvo o residuos para mejorar fotosíntesis.'],
            ['nombre' => 'Trasplante', 'descripcion' => 'Cambio de maceta o suelo para mejor desarrollo.'],
            ['nombre' => 'Exposición solar', 'descripcion' => 'Asegurar luz adecuada, mover la planta si es necesario.'],
        ];

        foreach ($cuidados as $cuidado) {
            Cuidado::updateOrCreate([
                'nombre' => $cuidado['nombre'],
            ], $cuidado);
        }
    }
}