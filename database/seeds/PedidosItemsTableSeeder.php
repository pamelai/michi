<?php

use Illuminate\Database\Seeder;

class PedidosItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pedidosItems')->insert([
            'item_id' => 1,
            'producto_id' => 6,
            'cantidad' => 2,
            'precio' => 340,
            'pedido_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 2,
            'producto_id' => 3,
            'cantidad' => 3,
            'precio' => 3862.20,
            'pedido_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 3,
            'producto_id' => 8,
            'cantidad' => 2,
            'precio' => 808.40,
            'pedido_id' => 2,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 4,
            'producto_id' => 7,
            'cantidad' => 1,
            'precio' => 715.80,
            'pedido_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 5,
            'producto_id' => 4,
            'cantidad' => 1,
            'precio' => 484.40,
            'pedido_id' => 3,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 6,
            'producto_id' => 4,
            'cantidad' => 1,
            'precio' => 484.40,
            'pedido_id' => 4,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 7,
            'producto_id' => 6,
            'cantidad' => 3,
            'precio' => 510,
            'pedido_id' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 8,
            'producto_id' => 2,
            'cantidad' => 1,
            'precio' => 1176.20,
            'pedido_id' => 6,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 9,
            'producto_id' => 4,
            'cantidad' => 1,
            'precio' => 484.40,
            'pedido_id' => 6,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 10,
            'producto_id' => 5,
            'cantidad' => 2,
            'precio' => 469,
            'pedido_id' => 7,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 11,
            'producto_id' => 5,
            'cantidad' => 3,
            'precio' => 1407,
            'pedido_id' => 8,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 12,
            'producto_id' => 8,
            'cantidad' => 1,
            'precio' => 404.20,
            'pedido_id' => 9,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 13,
            'producto_id' => 2,
            'cantidad' => 1,
            'precio' => 1176.20,
            'pedido_id' => 10,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('pedidosItems')->insert([
            'item_id' => 14,
            'producto_id' => 3,
            'cantidad' => 1,
            'precio' => 1287.40,
            'pedido_id' => 11,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
