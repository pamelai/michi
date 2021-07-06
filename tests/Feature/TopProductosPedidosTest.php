<?php

namespace Tests\Feature;

use App\Models\PedidosItems;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TopProductosPedidosTest extends TestCase
{
    use RefreshDatabase;

    public function testCantidadTopProductosPedidosDondeElItem0DePedidosEsUnaInstanciaDeLaClasePedidosYSinEspecificarFecha()
    {
        $this->seed();

        $estadistica = PedidosItems::cantidadTopProductosPedidos();

        $this->assertInstanceOf(PedidosItems::class, $estadistica["pedidosItems"][0]);
        $this->assertEquals("", $estadistica["fecha_consultada"]);
    }

    public function testCantidadTopProductosPedidosConAño2019YMes11()
    {
        $this->seed();

        $estadistica = PedidosItems::cantidadTopProductosPedidos("2019","11");

        $this->assertEquals("2019/11", $estadistica["fecha_consultada"]);
    }

    public function testCantidadTopProductosPedidosDondeMesesDisponiblesItem1SeaString()
    {
        $this->seed();

        $estadistica = PedidosItems::cantidadTopProductosPedidos("2019","12");

        $this->assertIsString($estadistica["fechas_disponibles"][0]);
    }

    public function testCantidadTopProductosPedidosDondeNoDevuelvaDataCuandoSeConsultaUnaFechaSinDatos()
    {
        $this->seed();

        $estadistica = PedidosItems::cantidadTopProductosPedidos("2019","10");

        $this->assertEmpty($estadistica["pedidosItems"]);
    }
}
