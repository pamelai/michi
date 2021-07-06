<?php

namespace Tests\Feature;

use App\Models\Pedidos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PedidosPorMesTest extends TestCase
{
    use RefreshDatabase;

    public function testCantidadPedidosPorMesDondeElItem0DePedidosEsUnaInstanciaDeLaClasePedidos()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosPorMes(2020);

        $this->assertInstanceOf(Pedidos::class, $estadistica["pedidos"][0]);
    }

    public function testCantidadPedidosPorMesDondeElItem1SeaEntero()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosPorMes(2020);

        $this->assertIsInt($estadistica["años_disponibles"][1]);
    }

    public function testCantidadPedidosPorMesDondeAñoConsultadoSea2019()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosPorMes(2019);

        $this->assertEquals(2019, $estadistica["año_consultado"]);
    }

    public function testCantidadPedidosPorMesDondeNoDevuelvaDataCuandoSeConsultaUnaFechaSinDatos()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosPorMes(2018);

        $this->assertEmpty($estadistica["pedidos"]);
    }
}
