<?php

use Illuminate\Database\Seeder;

class CarritoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carrito')->insert([
            'carrito_id' => 1,
            'item_id' => 1,
            'usuario_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('carrito')->insert([
            'carrito_id' => 2,
            'item_id' => 2,
            'usuario_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
