<?php

namespace App\Http\Controllers;

use App\Models\EstadoPedido;
use App\Models\Producto;
use App\Models\Pedidos;
use App\Models\TipoUser;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    /**
     * Listado de todos los productos y pedidos para el panel de administración
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function panel()
    {
        $productos = Producto::with(['categoria'])->paginate(10);
        $pedidos = Pedidos::paginate(10);
        $usuarios = Usuario::paginate(10);
        $estados_pedidos = EstadoPedido::all();
        $tipo_user = TipoUser::all();

        return view('panel.index', [
            'productos' => $productos,
            'pedidos' => $pedidos,
            'usuarios' => $usuarios,
            'tipo_user' => $tipo_user,
            'estados_pedidos' => $estados_pedidos
        ]);
    }
}
