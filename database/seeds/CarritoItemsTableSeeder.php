<?php

use Illuminate\Database\Seeder;

class CarritoItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carritoItems')->insert([
            'item_id' => 1,
            'producto_id' => 1,
            'cantidad' => 2,
            'precio' => 1669.70,
            'subtotal' => 3339.40,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('carritoItems')->insert([
            'item_id' => 2,
            'producto_id' => 6,
            'cantidad' => 1,
            'precio' => 170,
            'subtotal' => 170,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
