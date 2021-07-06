<?php

namespace Tests\Feature;

use App\Models\Pedidos;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PedidosEntregadosYAnuladosTest extends TestCase
{
    use RefreshDatabase;

    public function testCantidadPedidosEntregadosYAnuladosDondeElItem0DePedidosEsUnaInstanciaDeLaClasePedidosYSinEspecificarFecha()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosEntregadosYAnulados();

        $this->assertInstanceOf(Pedidos::class, $estadistica["pedidos"][0]);
        $this->assertEquals("", $estadistica["mes_consultado"]);
    }

    public function testCantidadPedidosEntregadosYAnuladosConAño2020YMes04()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosEntregadosYAnulados("2020","04");

        $this->assertEquals("2020/04", $estadistica["mes_consultado"]);
    }

    public function testCantidadPedidosEntregadosYAnuladosDondeMesesDisponiblesItem1SeaString()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosEntregadosYAnulados("2020","04");

        $this->assertIsString($estadistica["meses_disponibles"][0]);
    }

    public function testCantidadPedidosEntregadosYAnuladosDondeNoDevuelvaDataCuandoSeConsultaUnaFechaSinDatos()
    {
        $this->seed();

        $estadistica = Pedidos::cantidadPedidosEntregadosYAnulados("2019","07");

        $this->assertEmpty($estadistica["pedidos"]);
    }

}
