<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Problema;

class ProblemasSeeder extends Seeder
{
    public function run(): void
    {
        $problemas = [
            ['nombre' => 'Ácaros (araña roja)', 'imagen' => 'https://www.agrogm.com/wp-content/uploads/2023/02/ara-a-roja-3.jpg', 'descripcion' => 'Pequeños ácaros que causan punteaduras amarillas y telarañas.'],
            ['nombre' => 'Pulgones', 'imagen' => 'https://www.floresyplantas.net/wp-content/uploads/pulgones-en-planta1.jpg', 'descripcion' => 'Insectos chupadores que deforman brotes y hojas.'],
            ['nombre' => 'Cochinilla algodonosa', 'imagen' => 'https://cdn0.uncomo.com/es/posts/2/2/8/como_eliminar_la_cochinilla_algodonosa_49822_orig.jpg', 'descripcion' => 'Plaga algodonosa que debilita la planta.'],
            ['nombre' => 'Mosca blanca', 'imagen' => 'https://www.gardentech.com/-/media/project/oneweb/gardentech/images/pest-id/updated-bug-post/whiteflies/pupae-on-a-leaf.jpg', 'descripcion' => 'Pequeños insectos blancos que chupan savia y transmiten virus.'],
            ['nombre' => 'Hongo Mildiú', 'imagen' => 'https://www.humboldtseeds.net/uploads/Mildiu_Mildew_hso_portada_960x581.jpg', 'descripcion' => 'Manchas blancas o grises en hojas.'],
            ['nombre' => 'Hongo Roya', 'imagen' => 'https://static.matabi.com/media/magefan_blog/generalVF-1.jpg', 'descripcion' => 'Pústulas anaranjadas en el envés de las hojas.'],
            ['nombre' => 'Bacteria (mancha foliar)', 'imagen' => 'https://www.vegetables.bayer.com/mx/es-mx/recursos/agronomic-spotlights/conociendo-las-manchas-foliares-en-pimientos/_jcr_content/root/responsivegrid/responsivegrid/image.coreimg.jpeg/1629410261239/foliares.jpeg', 'descripcion' => 'Manchas negras acuosas en hojas.'],
            ['nombre' => 'Deficiencia de nitrógeno', 'imagen' => 'https://eos.com/wp-content/uploads/2021/07/cucumber-leaves-yellowing.jpg.webp', 'descripcion' => 'Amarillamiento general, hojas viejas primero.'],
            ['nombre' => 'Exceso de riego', 'imagen' => 'https://i.ytimg.com/vi/PB_l7v7yIko/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLDgSSJDFvx0Ii6KeY2B7vIcVPDEiQ', 'descripcion' => 'Hojas amarillas, raíces podridas.'],
            ['nombre' => 'Falta de luz', 'imagen' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRB90GznnuhZJ9SZkI-wntF0KluQAOueo7Yrg&s', 'descripcion' => 'Crecimiento débil, hojas pequeñas y pálidas.'],
        ];

        foreach ($problemas as $problema) {
            Problema::create($problema);
        }
    }
}