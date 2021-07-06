<?php

use Illuminate\Database\Seeder;

class PedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pedidos')->insert([
            'pedido_id' => 1,
            'precio' => 4202.20,
            'calle' => 'Av. Bartolomé Mitre',
            'altura' => 4953,
            'fecha' => '2019-12-18',
            'payment_id' => 857256,
            'ubicacion_id' => 1,
            'usuario_id' => 1,
            'estado_id' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidos')->insert([
            'pedido_id' => 2,
            'precio' => 808.40,
            'calle' => 'Zeballos',
            'altura' => 4589,
            'fecha' => '2019-12-15',
            'payment_id' => 567936,
            'ubicacion_id' => 1,
            'usuario_id' => 2,
            'estado_id' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidos')->insert([
            'pedido_id' => 3,
            'precio' => 1200.20,
            'calle' => 'Mariano Moreno',
            'altura' => 6185,
            'fecha' => '2019-12-18',
            'payment_id' => 465787,
            'ubicacion_id' => 1,
            'usuario_id' => 2,
            'estado_id' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidos')->insert([
            'pedido_id' => 4,
            'precio' => 484.40,
            'calle' => 'Rondeau',
            'altura' => 7598,
            'fecha' => '2019-12-15',
            'payment_id' => 825167,
            'ubicacion_id' => 2,
            'usuario_id' => 1,
            'estado_id' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidos')->insert([
            'pedido_id' => 5,
            'precio' => 510,
            'calle' => 'Av. Caseros',
            'altura' => 2598,
            'fecha' => '2019-11-29',
            'payment_id' => 985169,
            'ubicacion_id' => 5,
            'usuario_id' => 3,
            'estado_id' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidos')->insert([
            'pedido_id' => 6,
            'precio' => 1659.60,
            'calle' => 'Belgrano',
            'altura' => 547,
            'fecha' => '2019-11-29',
            'payment_id' => 987438,
            'ubicacion_id' => 4,
            'usuario_id' => 4,
            'estado_id' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidos')->insert([
            'pedido_id' => 7,
            'precio' => 938,
            'calle' => 'Humberto Primo',
            'altura' => 383,
            'fecha' => '2019-11-29',
            'payment_id' => 816793,
            'ubicacion_id' => 6,
            'usuario_id' => 4,
            'estado_id' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidos')->insert([
            'pedido_id' => 8,
            'precio' => 1407,
            'calle' => '9 de julio',
            'altura' => 362,
            'fecha' => '2020-04-25',
            'payment_id' => 745689,
            'ubicacion_id' => 6,
            'usuario_id' => 5,
            'estado_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidos')->insert([
            'pedido_id' => 9,
            'precio' => 404.20,
            'calle' => 'José Martín de la Serna',
            'altura' => 767,
            'fecha' => '2020-06-08',
            'payment_id' => 656365,
            'ubicacion_id' => 7,
            'usuario_id' => 5,
            'estado_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidos')->insert([
            'pedido_id' => 10,
            'precio' => 1176.20,
            'calle' => 'Italia',
            'altura' => 53,
            'fecha' => '2020-07-12',
            'payment_id' => 686838,
            'ubicacion_id' => 3,
            'usuario_id' => 3,
            'estado_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidos')->insert([
            'pedido_id' => 11,
            'precio' => 1287.40,
            'calle' => 'San Martín',
            'altura' => 793,
            'fecha' => '2020-07-14',
            'payment_id' => 698697,
            'ubicacion_id' => 3,
            'usuario_id' => 3,
            'estado_id' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
