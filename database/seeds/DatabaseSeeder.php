<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TipoUsuariosTableSeeder::class);
        $this->call(UsuariosTableSeeder::class);
        $this->call(CategoriasTableSeeder::class);
        $this->call(MarcasTableSeeder::class);
        $this->call(TipoAlimentoTableSeeder::class);
        $this->call(EdadesTableSeeder::class);
        $this->call(UnidadesTableSeeder::class);
        $this->call(ProductosTableSeeder::class);
        $this->call(CarritoItemsTableSeeder::class);
        $this->call(CarritoTableSeeder::class);
        $this->call(UbicacionesTableSeeder::class);
        $this->call(EstadoPedidoTableSeeder::class);
        $this->call(PedidosTableSeeder::class);
        $this->call(PedidosItemsTableSeeder::class);
    }
}
