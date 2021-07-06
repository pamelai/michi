<?php

use Illuminate\Database\Seeder;

class ProductosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('productos')->insert([
            'producto_id' => 1,
            'nombre' => 'Pro Plan: Sensitive Cat',
            'precio' => 1669.70,
            'descripcion' => 'Purina Pro Plan Sensitive Salmón y Arroz Optiderma con omega 3 y 6 ofrece una nutrición específica para los gatos sensibles, promoviendo una salud óptima y bienestar general. Entre sus principales beneficios se destaca que: incluye carne fresca de salmón como primer ingrediente en su fórmula para reducir las reacciones alimentarias adversas; se basa en una receta palatable y permite el mantenimiento de un pelaje brilloso y sedoso.',
            'img' => 'proplansensitive.jpg',
            'peso' => 3,
            'promo' => 1,
            'unidad_id' => 1,
            'edad_id' => 2,
            'tipoAlimento_id' => 2,
            'marca_id' => 2,
            'categoria_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('productos')->insert([
            'producto_id' => 2,
            'nombre' => 'Whiskas: Gatitos ',
            'precio' => 1176.20,
            'descripcion' => 'Whiskas gatitos es un alimento para cachorros hasta los 12 meses de edad. Contiene croquetas con más sabor y relleno cremoso para satisfacer el exigente paladar de los gatos. Whiskas tiene un sabor inigualable que contiene todos los nutrientes necesarios para una alimentación completa. Su formulación estimula la ingesta de agua ayudando a mantener el tracto urinario saludable.',
            'img' => 'whiskasgatitos.jpg',
            'peso' => 10,
            'unidad_id' => 1,
            'edad_id' => 1,
            'tipoAlimento_id' => 6,
            'marca_id' => 1,
            'categoria_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('productos')->insert([
            'producto_id' => 3,
            'nombre' => 'Eurolitter: Arena Sanitaria',
            'precio' => 1287.40,
            'descripcion' => 'Arena sanitaria para gatos con gran capacidad aglomerante. Gracias a su alta capacidad de absorción ayuda a reducir el consumo de producto. Controla aromas y está fabricada con ingredientes naturales. Fragancia lavanda.',
            'img' => 'eurolitterarena.jpg',
            'peso' => 7,
            'unidad_id' => 1,
            'marca_id' => 3,
            'categoria_id' => 6,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('productos')->insert([
            'producto_id' => 4,
            'nombre' => 'CanCat: Piedra Silica',
            'precio' => 484.40,
            'descripcion' => 'Estas piedras sanitarias de sílica funcionan, al mismo tiempo, como una herramienta para monitorear el funcionamiento del tracto urinario de tu gato. Son indicadores de orina alcalina, que podría asociarse con cálculos renales, infecciones urinarias y otros problemas relacionados con el sistema urinario y el hígado. Mediante una escala de colores que el producto presentará en contacto con el líquido, podrás detectar anomalías incluso antes de que se presenten síntomas. Además, garantiza la óptima absorción de olores y líquidos y un ambiente libre de bacterias.',
            'img' => 'cancatpiedrasilica.jpg',
            'peso' => 3.8,
            'promo' => 1,
            'unidad_id' => 3,
            'marca_id' => 4,
            'categoria_id' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('productos')->insert([
            'producto_id' => 5,
            'nombre' => 'Comfortis: Antipulgas',
            'precio' => 469,
            'descripcion' => 'Comfortis es una pastilla para perros de 4 a 9 kg, antipulga de rápida acción, funciona muy bien y reemplaza a la pipeta. La actividad preventiva y terapéutica, también tiene acción continua en 30 minutos las pulgas comienzan a morir después de las cuatro horas de aplicación, el 100% de las pulgas se eliminan y su eficacia dura 30 días aproximadamente.',
            'img' => 'comfortis49.jpg',
            'rango_peso' => '4-9',
            'unidad_id' => 1,
            'marca_id' => 5,
            'categoria_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('productos')->insert([
            'producto_id' => 6,
            'nombre' => 'Power: Antipulgas',
            'precio' => 170,
            'descripcion' => 'Power gato hasta 4 kg está indicado para la prevención y el tratamiento de la infestación por pulgas.',
            'img' => 'power4.jpg',
            'rango_peso' => '0-4',
            'promo' => 1,
            'unidad_id' => 1,
            'marca_id' => 6,
            'categoria_id' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('productos')->insert([
            'producto_id' => 7,
            'nombre' => 'Cepillo de goma: Antipelos',
            'precio' => 715.80,
            'descripcion' => 'Cepillo que remueve fácilmente pelusa y pelo de las mascotas mediante sus tres laterales que eliminan la suciedad de todo tipo de superficies. Es la herramienta ideal para mantener nuestros espacios libres de pelos. Elaborado con caucho natural de color negro.',
            'img' => 'cepillogomaantipelo.jpg',
            'marca_id' => 8,
            'categoria_id' => 7,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('productos')->insert([
            'producto_id' => 8,
            'nombre' => 'Collar ajustable',
            'precio' => 404.20,
            'descripcion' => 'Este es un collar de nylon para gatos con lengüeta y hebilla metálica. Este producto se ajusta perfectamente al cuello de tu mascota. Su color es negro, pero podés consultarnos por disponibilidad en otros colores.',
            'img' => 'collarajustable.jpg',
            'marca_id' => 8,
            'categoria_id' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
