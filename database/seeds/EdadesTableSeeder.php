<?php

use Illuminate\Database\Seeder;

class EdadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('edades')->insert([
            'edad_id' => 1,
            'edad' => 'Cachorro',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('edades')->insert([
            'edad_id' => 2,
            'edad' => 'Adulto',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('edades')->insert([
            'edad_id' => 3,
            'edad' => 'Senior',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
