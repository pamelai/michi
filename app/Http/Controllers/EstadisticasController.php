<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\PedidosItems;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    /**
     * Trae los productos más vendidos que no pertenezcan a un pedido anulado. Todos o según una fecha
     *
     * @param null $anio
     * @param null $mes
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function topProductos($anio = null, $mes = null)
    {
        if ($anio && $mes)
            $productos = PedidosItems::cantidadTopProductosPedidos($anio, $mes);
        else
            $productos = PedidosItems::cantidadTopProductosPedidos();

        return view('panel.top-productos', ['productos' => $productos]);
    }

    /**
     * Trae la cantidad de pedidos (no anulados) por mes por año
     *
     * @param int $anio
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function topMeses($anio)
    {
        $pedidos = Pedidos::cantidadPedidosPorMes($anio);

        return view('panel.top-pedidos-meses', [
            'pedidos' => $pedidos
        ]);
    }

    /**
     * Trae los pedidos entregados y anulados. Todos o según una fecha
     *
     * @param null $anio
     * @param null $mes
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function pedidosEntregadosAnulados($anio = null, $mes = null)
    {
        if ($anio && $mes)
            $pedidos = Pedidos::cantidadPedidosEntregadosYAnulados($anio, $mes);
        else
            $pedidos = Pedidos::cantidadPedidosEntregadosYAnulados();

        return view('panel.pedidos-entregados', ['pedidos' => $pedidos]);
    }

    /**
     * Trae los pedidos (entregados o confirmados) por zona. Todos o según una fecha
     *
     * @param null $anio
     * @param null $mes
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function pedidosPorZona($anio = null, $mes = null)
    {
        if ($anio && $mes)
            $pedidos = Pedidos::cantidadPedidosPorZona($anio, $mes);
        else
            $pedidos = Pedidos::cantidadPedidosPorZona();

        return view('panel.pedidos-zona', ['pedidos' => $pedidos]);
    }
}
