<?php

namespace Tests\Feature;

use App\Models\Pedidos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PedidosPorZonaTest extends TestCase
{
    use RefreshDatabase;

    public function testCantidadPedidosPorZonaDondeElItem0DePedidosEsUnaInstanciaDeLaClasePedidosYSinEspecificarFecha()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosPorZona();

        $this->assertInstanceOf(Pedidos::class, $estadistica["pedidos"][0]);
        $this->assertEquals("", $estadistica["mes_consultado"]);
    }

    public function testCantidadPedidosPorZonaConAño2020YMes07()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosPorZona("2020","07");

        $this->assertEquals("2020/07", $estadistica["mes_consultado"]);
    }

    public function testCantidadPedidosPorZonaDondeMesesDisponiblesItem1SeaString()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosPorZona("2020","07");

        $this->assertIsString($estadistica["meses_disponibles"][0]);
    }

    public function testCantidadPedidosPorZonaDondeNoDevuelvaDataCuandoSeConsultaUnaFechaSinDatos()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosPorZona("2019","07");

        $this->assertEmpty($estadistica["pedidos"]);
    }
}
