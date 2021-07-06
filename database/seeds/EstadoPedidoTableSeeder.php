<?php

use Illuminate\Database\Seeder;

class EstadoPedidoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estadoPedido')->insert([
            'estado_id' => 1,
            'estado' => 'Orden recibida',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('estadoPedido')->insert([
            'estado_id' => 2,
            'estado' => 'Orden confirmada',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('estadoPedido')->insert([
            'estado_id' => 3,
            'estado' => 'Orden anulada',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('estadoPedido')->insert([
            'estado_id' => 4,
            'estado' => 'Orden en camino',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('estadoPedido')->insert([
            'estado_id' => 5,
            'estado' => 'Orden entregada',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

    }
}
