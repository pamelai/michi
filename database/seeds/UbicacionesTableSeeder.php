<?php

use Illuminate\Database\Seeder;

class UbicacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ubicaciones')->insert([
            'ubicacion_id' => 1,
            'provincia' => 'Buenos Aires',
            'partido' => 'Avellaneda',
            'localidad' => 'Villa Domínico',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('ubicaciones')->insert([
            'ubicacion_id' => 2,
            'provincia' => 'Buenos Aires',
            'partido' => 'Avellaneda',
            'localidad' => 'Wilde',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('ubicaciones')->insert([
            'ubicacion_id' => 3,
            'provincia' => 'Buenos Aires',
            'partido' => 'Avellaneda',
            'localidad' => 'Avellaneda Centro',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('ubicaciones')->insert([
            'ubicacion_id' => 4,
            'provincia' => 'Buenos Aires',
            'partido' => 'Quilmes',
            'localidad' => 'Bernal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('ubicaciones')->insert([
            'ubicacion_id' => 5,
            'provincia' => 'Buenos Aires',
            'partido' => 'Quilmes',
            'localidad' => 'Don Bosco',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('ubicaciones')->insert([
            'ubicacion_id' => 6,
            'provincia' => 'Buenos Aires',
            'partido' => 'Quilmes',
            'localidad' => 'Quilmes Centro',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('ubicaciones')->insert([
            'ubicacion_id' => 7,
            'provincia' => 'Buenos Aires',
            'partido' => 'Lanús',
            'localidad' => 'Gerli',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('ubicaciones')->insert([
            'ubicacion_id' => 8,
            'provincia' => 'Buenos Aires',
            'partido' => 'Lanús',
            'localidad' => 'Monte Chingolo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('ubicaciones')->insert([
            'ubicacion_id' => 9,
            'provincia' => 'Buenos Aires',
            'partido' => 'Lanús',
            'localidad' => 'Lanús Centro',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
