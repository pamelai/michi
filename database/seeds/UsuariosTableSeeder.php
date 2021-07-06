<?php

use Illuminate\Database\Seeder;

class UsuariosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios')->insert([
            'usuario_id' => 1,
            'nombre' => 'Pamela',
            'apellido' => 'Iglesias',
            'email' => 'pamelaiglesias96@gmail.com',
            'user_name' => 'pi',
            'password' => Hash::make('123'),
            'tipo_id' => 1,
            'remember_token' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('usuarios')->insert([
            'usuario_id' => 2,
            'nombre' => 'Elba',
            'apellido' => 'Jonaso',
            'email' => 'elbajonaso@gmail.com',
            'user_name' => 'elba_jona',
            'password' => Hash::make('123456'),
            'tipo_id' => 2,
            'remember_token' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('usuarios')->insert([
            'usuario_id' => 3,
            'nombre' => 'Santi',
            'apellido' => 'Palomito',
            'email' => 'santipalomito@gmail.com',
            'user_name' => 'santi_palo',
            'password' => Hash::make('bestpassever'),
            'tipo_id' => 2,
            'remember_token' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('usuarios')->insert([
            'usuario_id' => 4,
            'nombre' => 'Emma',
            'apellido' => 'Albizu',
            'email' => 'emmakpa@gmail.com',
            'user_name' => 'emmaKpa',
            'password' => Hash::make('emma123'),
            'tipo_id' => 2,
            'remember_token' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('usuarios')->insert([
            'usuario_id' => 5,
            'nombre' => 'Juan',
            'apellido' => 'Gonzáles',
            'email' => 'juangon@gmail.com',
            'user_name' => 'juampi1',
            'password' => Hash::make('pass123'),
            'tipo_id' => 2,
            'remember_token' => null,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
