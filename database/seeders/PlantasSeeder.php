<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Planta;

class PlantasSeeder extends Seeder
{
    public function run(): void
    {
        $plantas = [
            [
                'nombre' => 'Bouganvilla',
                'especie' => 'Bougainvillea glabra',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://upload.wikimedia.org/wikipedia/commons/f/f8/Starr_030418-0058_Bougainvillea_spectabilis.jpg',
                'descripcion' => 'Planta trepadora con brácteas coloridas, resistente a la sequía. Ideal para muros y pérgolas.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Ocote (Pino mexicano)',
                'especie' => 'Pinus patula',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://upload.wikimedia.org/wikipedia/commons/2/29/PiedrasEncimadas69.JPG',
                'descripcion' => 'Árbol de rápido crecimiento, adaptable a climas cálidos.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Palma real',
                'especie' => 'Roystonea regia',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://universopalmeras.com/wp-content/uploads/2017/12/roystonea_regia.jpg',
                'descripcion' => 'Palma alta y elegante, típica del trópico.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Plumeria (Frangipani)',
                'especie' => 'Plumeria rubra',
                'tipo_zona' => 'Sol parcial',
                'imagen' => 'https://www.gardenia.net/wp-content/uploads/2023/04/qbKDvWjpvPeWkmEvN58TyrLBnvXiwBTtWD9w7T5F.webp',
                'descripcion' => 'Flores fragantes y vistosas, resistente a sequía.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Agave azul',
                'especie' => 'Agave tequilana',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://imagenes.eleconomista.com.mx/files/webp_768_448/uploads/2025/07/21/687ef8134c6df.jpeg',
                'descripcion' => 'Suculenta grande, usada para tequila, muy resistente.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Hibisco',
                'especie' => 'Hibiscus rosa-sinensis',
                'tipo_zona' => 'Sol parcial',
                'imagen' => 'https://casaplantavigo.com/blog/wp-content/uploads/2023/06/Hibisco-Casaplanta-cuidados.jpg',
                'descripcion' => 'Flores grandes y coloridas, necesita humedad regular.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Crotón',
                'especie' => 'Codiaeum variegatum',
                'tipo_zona' => 'Luz brillante indirecta',
                'imagen' => 'https://www.hola.com/horizon/square/56be84b10084-cuidados-croton-01t-t.jpg',
                'descripcion' => 'Hojas multicolores, ideal para interiores o exteriores protegidos.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Duranta (Violeta)',
                'especie' => 'Duranta erecta',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjbK-hh1val8eo8kdYvyWanL6x9q3CefAgi4NCGHKC7KFoeLcpVh_A_0d1aSVexB2FhcvxL-z-CffDwQPRTDvftgDPdbfw99yc1rpbQl_C3N4krCwY6IB_K-Qjo1Oyctl3d7Ko_1a5N584/w1200-h630-p-k-no-nu/1.jpg',
                'descripcion' => 'Arbusto con flores lilas y frutos amarillos, atrae mariposas.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Lantana',
                'especie' => 'Lantana camara',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://i.blogs.es/1c92c1/1641398317-0d2327c7/450_1000.jpeg',
                'descripcion' => 'Flores multicolores, muy resistente a la sequía.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Nochebuena (Poinsettia)',
                'especie' => 'Euphorbia pulcherrima',
                'tipo_zona' => 'Luz brillante',
                'imagen' => 'https://www.cocinadelirante.com/688x459/filters:format(webp):quality(75)/sites/default/files/styles/gallerie/public/reproducir-nochebuena-con-ramita.jpg',
                'descripcion' => 'Planta navideña mexicana, requiere cuidado en riego.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Yuca',
                'especie' => 'Yucca gloriosa',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://www.staymag.com/wp-content/uploads/2025/10/yuca-como-cuidar-1280x720.jpg',
                'descripcion' => 'Planta de hojas rígidas, muy resistente a la sequía y calor.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Sábila (Aloe vera)',
                'especie' => 'Aloe barbadensis',
                'tipo_zona' => 'Sol parcial',
                'imagen' => 'https://hidroponia.mx/wp-content/uploads/2017/10/aloe-vera-1.jpg',
                'descripcion' => 'Suculenta medicinal, necesita poco riego.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Cedro limón',
                'especie' => 'Cedrela odorata',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://www.cocinavital.mx/wp-content/uploads/2022/12/cuidados-pinolimon-634x420.jpg',
                'descripcion' => 'Árbol de madera preciosa, crece bien en climas cálidos.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Jazmín del Cabo',
                'especie' => 'Gardenia jasminoides',
                'tipo_zona' => 'Sombra parcial',
                'imagen' => 'https://cdnx.jumpseller.com/camelia-y-lavanda/image/41521116/thumb/1079/1079?1763732570',
                'descripcion' => 'Flores blancas muy fragantes, necesita suelo ácido y humedad.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Mango',
                'especie' => 'Mangifera indica',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://cdn0.ecologiaverde.com/es/posts/1/1/9/cultivo_y_cuidados_del_arbol_del_mango_911_orig.jpg',
                'descripcion' => 'Árbol frutal tropical, produce mangos dulces.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Papaya',
                'especie' => 'Carica papaya',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://imagenes.excelsior.com.mx/files/main_image_375_249/uploads/2026/04/22/69e921d371ee2.jpeg',
                'descripcion' => 'Fruta tropical, crecimiento rápido.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Cítricos (Naranjo)',
                'especie' => 'Citrus sinensis',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://cdn.monstera-app.com/p/a7f1ec866d9d95322900aebed9aae453684f1eae8bb8787712abcd7d0ae95f80.jpg/naranjo-joven-citrus-sinensis-en-maceta.webp?filter=swiper',
                'descripcion' => 'Árbol frutal, flores aromáticas.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Helecho de Boston',
                'especie' => 'Nephrolepis exaltata',
                'tipo_zona' => 'Sombra',
                'imagen' => 'https://adamsfarms.com/wp-content/uploads/2022/05/Boston-Fern-new.jpg',
                'descripcion' => 'Planta de interior colgante, necesita alta humedad.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Sansevieria (Lengua de suegra)',
                'especie' => 'Sansevieria trifasciata',
                'tipo_zona' => 'Luz baja a brillante',
                'imagen' => 'https://ayimala.com/wp-content/uploads/2024/08/Sansevieria_-Significado-Beneficios-y-Cuidados-de-la-Planta-que-Purifica-tu-Hogar-1.webp',
                'descripcion' => 'Planta muy resistente, purifica el aire.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Rosal',
                'especie' => 'Rosa sp.',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://content.cuerpomente.com/medio/2024/03/14/como-cuidar-rosal-maceta_fd2f0fba_240314173008_1200x630.jpg',
                'descripcion' => 'Arbusto ornamental con flores vistosas.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Buganvilia (enana)',
                'especie' => 'Bougainvillea spectabilis "enana"',
                'tipo_zona' => 'Pleno sol',
                'imagen' => 'https://media.admagazine.com/photos/618a5ff5b94700461d621187/master/w_1600%2Cc_limit/86915.jpg',
                'descripcion' => 'Variedad compacta, ideal para macetas.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Pata de elefante',
                'especie' => 'Beaucarnea recurvata',
                'tipo_zona' => 'Luz brillante',
                'imagen' => 'https://cdn.assets-casacor.tec.br/file/casacor-images-news/2021/11/luciano-zanardo.webp',
                'descripcion' => 'Planta de interior con tronco engrosado, almacena agua.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Cuerno de alce',
                'especie' => 'Platycerium bifurcatum',
                'tipo_zona' => 'Sombra parcial',
                'imagen' => 'https://growtropicals.com/cdn/shop/files/campo-1-6.jpg?v=1706273003&width=1080',
                'descripcion' => 'Helecho epífito, se monta en tablas.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Oreja de elefante',
                'especie' => 'Alocasia amazonica',
                'tipo_zona' => 'Sombra parcial',
                'imagen' => 'https://falconagroalimentaria.com/wp-content/uploads/2025/06/planta-alocasia.webp',
                'descripcion' => 'Grandes hojas en forma de punta de flecha.',
                'estado' => 'saludable',
            ],
            [
                'nombre' => 'Cactus de Navidad',
                'especie' => 'Schlumbergera truncata',
                'tipo_zona' => 'Luz indirecta',
                'imagen' => 'https://content.elmueble.com/medio/2020/11/27/cactus-de-navidad_7f63003e_674x446.jpg',
                'descripcion' => 'Florece en invierno, necesita humedad moderada.',
                'estado' => 'saludable',
            ],
        ];

        foreach ($plantas as $data) {
            // Actualiza si ya existe una planta con el mismo nombre y especie, o la crea si no.
            Planta::updateOrCreate(
                ['nombre' => $data['nombre'], 'especie' => $data['especie']],
                $data
            );
        }
    }
}