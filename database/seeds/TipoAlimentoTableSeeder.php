<?php

use Illuminate\Database\Seeder;

class TipoAlimentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipoAlimentos')->insert([
            'tipoAlimento_id' => 1,
            'tipo' => 'Light',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('tipoAlimentos')->insert([
            'tipoAlimento_id' => 2,
            'tipo' => 'Piel sensible',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('tipoAlimentos')->insert([
            'tipoAlimento_id' => 3,
            'tipo' => 'Medicado',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('tipoAlimentos')->insert([
            'tipoAlimento_id' => 4,
            'tipo' => 'Exigente',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('tipoAlimentos')->insert([
            'tipoAlimento_id' => 5,
            'tipo' => 'Digestivo',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('tipoAlimentos')->insert([
            'tipoAlimento_id' => 6,
            'tipo' => 'Clásico',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
